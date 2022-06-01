<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals =  Goal::all();

        $response = [
            'success' => true,
            'message' => 'Goals fetched successfully',
            'jsonData' => $goals,
        ];

        return response($response, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "goal" => "required|min:10",
            "due_date" => "required",
        ]);

        $goal = new Goal();
        $goal->goal = $request->input('goal');
        $goal->status = $request->input('status');
        $goal->due_date = $request->input('due_date');
        $goal->created_by = Auth::user()->id;
        $goal->save();

        // response
        $response = [
            'success' => true,
            'message' => 'Goal added successfully',
            'jsonData' => $goal,
        ];

        return response($response, 201); // 201 response for created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goal = Goal::findOrFail($id);
        $response = [
            'success' => true,
            'message' => 'Goal fetched successfully',
            'jsonData' => $goal,
        ];

        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $goal = Goal::find($id);
        $goal->update($request->all());
        $response = [
            'success' => true,
            'message' => 'Goal updated successfully',
            'jsonData' => $goal,
        ];

        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Goal::destroy($id);
        $response = [
            'success' => true,
            'message' => 'Goal deleted successfully',
        ];

        return response($response, 200);
    }
}
