<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show the user dashboard
    public function dashboard()

    {
        // Example subscription plans
        $plans = [
            ['name' => 'Basic Plan', 'price' => '10', 'features' => ['Access to basic workouts', 'Community support']],
            ['name' => 'Premium Plan', 'price' => '20', 'features' => ['Access to all workouts', 'Personalized programs', '1-on-1 coaching']],
            ['name' => 'Pro Plan', 'price' => '30', 'features' => ['All Premium features', 'Diet plans', 'Priority support']],
        ];

        // Check if the user's email is verified
        if (Auth::check() && Auth::user()->email_verified_at !== null) {
            // Pass plans to the view for verified users
            return view('user.dashboard', compact('plans'));
        }

        // Redirect to the verification notice page for unverified users
        return redirect()->route('verification.notice');
    }
}


