<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator; // Import Validator facade


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Check if the credentials match
        $user = DB::table('users')
                    ->where('UserEmail', $request->email)
                    ->where('UserPassword', $request->password) // Assuming you are not using hashed passwords
                    ->first();
    
        if ($user) {
            // If user found, log in and redirect with a success message
            session(['user' => $user]);
            return redirect()->route('dashboard')->with('success', 'Login successfull! Welcome to your dashboard.');
        } else {
            // If no user found, redirect back with an error message
            return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }
    

}