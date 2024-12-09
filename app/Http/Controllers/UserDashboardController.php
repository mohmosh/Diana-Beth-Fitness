<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch user subscription data and other relevant information.
        $user = auth()->user();
        $subscription = $user->subscription; // Assuming you have a relationship
        $progress = $subscription ? $subscription->progress_percentage : 0;

        return view('dashboard.index', compact('user', 'subscription', 'progress'));
    }
}
