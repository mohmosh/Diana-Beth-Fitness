<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TrackFreeTrial
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->subscription->plan->subscription_type === 'free_trial') {
            $user = Auth::user();

            // Set free_trial_started_at if not already set
            if (!$user->free_trial_started_at) {

                $user->update(['trial_start_date' => Carbon::now()]);
            }

            // Check if 7 days have passed
            if (Carbon::parse($user->free_trial_started_at)->diffInDays(Carbon::now()) >= 7) {
                return redirect()->route('subscription.plans')->with('error', 'Your free trial has expired. Please subscribe to continue.');
            }
        }

        return $next($request);
    }
}

