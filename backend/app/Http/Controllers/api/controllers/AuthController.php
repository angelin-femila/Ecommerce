<?php

namespace App\Http\Controllers\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Registration function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserName' => 'required|string|max:50',
            'UserEmail' => 'required|string|email|max:250|unique:users,UserEmail',
            'UserPassword' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Hashing the password
        $hashedPassword = Hash::make($request->input('UserPassword'));

        // Inserting data into the database
        $userId = DB::table('users')->insertGetId([
            'UserName' => $request->input('UserName'),
            'UserEmail' => $request->input('UserEmail'),
            'UserPassword' => $hashedPassword,
            'UserCreatedat' => now(),
            'UserUpdatedat' => now(),
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => [
                'id' => $userId,
                'name' => $request->input('UserName'),
                'email' => $request->input('UserEmail'),
            ]
        ], 201);
    }

    // Login function
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserEmail' => 'required|string|email|max:250',
            'UserPassword' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Retrieve the user
        $user = DB::table('users')->where('UserEmail', $request->input('UserEmail'))->first();

        if (!$user || !Hash::check($request->input('UserPassword'), $user->UserPassword)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Generate a token or use session-based authentication
        $token = Str::random(60); // Consider using a more secure method

        // Optionally, store the token in the database or a session
        // DB::table('user_tokens')->insert(['user_id' => $user->UserID, 'token' => $token]);

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->UserID,
                'name' => $user->UserName,
                'email' => $user->UserEmail,
            ]
        ], 200);
    }
}
