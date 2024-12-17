<?php


namespace App\Http\Middleware;

use Closure;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $routeName = $request->route()->getName();

        // Redirect to subscription prompt if the user doesn't have a subscription
        if (!$user->subscription) {
            return redirect()->route('subscriptions.prompt')->with('warning', 'Subscribe to access content.');
        }

        $plan = $user->subscription->plan;

        // Allow access if the user has a Premium subscription for all routes
        if ($routeName == 'forums.access' || $routeName == 'testimonials.access') {
            if ($plan->isPremium()) {
                return $next($request);
            }

            // If the user is not Premium, they can only access limited content (e.g., Testimonials with Normal subscription)
            if ($routeName == 'testimonials.access' && $plan->isNormal()) {
                return $next($request);
            }

            // Redirect if the user does not have a sufficient subscription level
            return redirect()->route('subscriptions.upgrade')->with('warning', 'Upgrade your subscription to access this feature.');
        }

        return $next($request);
    }
}


