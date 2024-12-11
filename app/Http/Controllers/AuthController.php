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

    // Login Logic
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed
            $user = Auth::user();

            // Redirect based on  the role
            if ($user->role_id === 1) {
                // Admin role
                return redirect()->route('adminTwo.dashboard')->with('success', 'Welcome Admin!');
            }

            if ($user->role_id === 2) {
                // User role
                // return redirect()->route('usersDashboard')->with('success', 'Welcome back!');
                return redirect()->route('users.index')->with('success', 'Welcome back!');

            }
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
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

