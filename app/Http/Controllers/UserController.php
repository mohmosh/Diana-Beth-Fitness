<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Prompts\Progress;

class UserController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated

        $user = Auth::user();
        dd($user);

        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch user subscription and progress
        $subscription = $user->subscription; // Ensure relationship is defined in User model


        $subscription = Subscription::all();



        // Pass data to the view
        dd('niko hapa');
        return view('dashboard.user', compact('user', 'subscription', ));
    }

    
}
