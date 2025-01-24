<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int|null  $subscriptionPlanId
     * @return mixed
     */
    public function handle($request, Closure $next, $subscriptionPlanId = null)
    {
        $user = Auth::user();

        // Allow unauthenticated users (e.g., for free trial content)
        if (!$user) {
            return $next($request);
        }

        // Skip check if no specific subscription plan is required
        if (!$subscriptionPlanId) {
            return $next($request);
        }

        // Restrict access if the user's subscription does not match
        if ($user->subscription_plan_id !== (int) $subscriptionPlanId) {
            return redirect()->route('subscriptions.index')->with('warning', 'Access denied. Subscription required.');
        }

        return $next($request);
    }
}
