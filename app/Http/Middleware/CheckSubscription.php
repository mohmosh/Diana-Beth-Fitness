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
     * @param  int  $subscriptionPlanId
     * @return mixed
     */
    public function handle($request, Closure $next, $subscriptionPlanId)
    {
        $user = Auth::user();

        if ($user->subscription_plan_id !== (int) $subscriptionPlanId) {
            return redirect()->route('subscriptions.index')->with('warning', 'Access denied. Subscription required.');
        }

        return $next($request);
    }
}
