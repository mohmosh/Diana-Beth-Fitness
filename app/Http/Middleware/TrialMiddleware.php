<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        

        if ($user->on_trial && now()->lessThanOrEqualTo($user->trial_end_date)) {
            return $next($request);
        }

        return redirect()->route('subscriptions.index')->with('error', 'Your trial has expired. Please subscribe to a plan.');
    }

}
