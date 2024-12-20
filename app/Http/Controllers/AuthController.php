<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Showing the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }



    // Login Logic
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists in the database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // If user is not registered, redirect to the registration form
            return redirect()->route('register')->with('warning', 'You need to register before logging in.');
        }

        // $user = Auth::user();

        // dd($user->role->name);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {

            // Authentication passed
            $user = Auth::user();

            // dd($user);


            // Redirect based on role
            if ($user->role->name === 'Admin') {

                Log::info('Admin authenticated.');

                // Admin role
                return redirect()->route('adminTwo.dashboard')->with('success', 'Welcome Admin!');
            }

            if ($user->role->name === 'User') {

                Log::info('User authenticated.');

                return redirect()->route('dashboard.user')->with('success', 'Welcome!');

            }
        }

        // Authentication failed
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    }







    // Logout logic
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'You have logged out.');
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'You have logged out.');
    }
}

