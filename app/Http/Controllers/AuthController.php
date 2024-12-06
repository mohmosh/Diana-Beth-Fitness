<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Showing the login form
    public function showLoginForm()
    {
        return view('auth.login');
        // return 'Login page is working!';
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Create a personal access token for the authenticated user
            $token = $user->createToken('DianaBethFitness')->plainTextToken;

            // Return the token in the response
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        }

        // Authentication failed
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }


    // Content Page
    public function fitnessContent()
    {
        return view('fitness');
    }

    // Logout logic
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'You have logged out.');
    }
}

