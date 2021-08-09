<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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

        // loggin out in laravel 8
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
