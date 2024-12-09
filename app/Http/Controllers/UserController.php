<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
        $user = auth()->user(); // Get authenticated user
        $progress = 50; // Example progress percentage, replace with actual logic
        $subscription = true; // Example subscription check, replace with actual logic
        return view('dashboard.user', compact('user', 'progress', 'subscription'));
    }



}


