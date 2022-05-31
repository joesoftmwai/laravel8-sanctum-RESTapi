<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // validate user
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // check  email first
        $user = User::where('email', $fields['email'])->first();

        // check  password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Please ensure you have entered correct email and password',
            ], 401);
        }

        // generate token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // response
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        // validate user
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',  // email unique to the users table
            'password' => 'required|min:6|confirmed'  // Confirm password
        ]);

        // create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // generate token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // response
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201); // 201 response for created

    }

    public function logout(Request $request)
    {

        // log out in laravel 8
        // Revoke all tokens...
        // 1. $user->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        // 2. $request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        // 3. $user->tokens()->where('id', $tokenId)->delete();

        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
