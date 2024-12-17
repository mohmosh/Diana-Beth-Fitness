<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

        // Check if the user exists in the database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // If user is not registered, redirect to the registration form
            return redirect()->route('register')->with('warning', 'You need to register before logging in.');
        }

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed
            $user = Auth::user();

            // dd($user);


            // Redirect based on role
            if ($user->role->name === 'admin') {


                Log::info('Admin authenticated.');


                // Admin role
                return redirect()->route('adminTwo.dashboard')->with('success', 'Welcome Admin!');
            }

            if ($user->role->name === 'user') {

                Log::info('User authenticated.');

                // User role: Check subscription status
                $subscription = $user->subscription;

                if (!$subscription) {
                    // No subscription found
                    // return('niko hapa');

                    // return redirect()->route('subscriptions.prompt')->with('warning', 'You need to subscribe to access content.');
                    return view('dashboard.user');
                }

                // Check subscription plan
                if ($subscription->plan->name === 'Basic') {
                    return redirect()->route('subscriptions.basic')->with('success', 'Welcome to the Basic Plan!');
                }

                if ($subscription->plan->name === 'Premium') {
                    return redirect()->route('subscriptions.premium')->with('success', 'Welcome to the Premium Plan!');
                }
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

