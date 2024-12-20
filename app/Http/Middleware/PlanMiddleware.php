<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredPlanId
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredPlanId)
    {
        $user = Auth::user();

        if (!$user || $user->plan_id < $requiredPlanId) {
            return redirect()->route('subscription.check')->with('warning', 'You need a higher subscription plan to access this feature.');
        }

        return $next($request);
    }
}

