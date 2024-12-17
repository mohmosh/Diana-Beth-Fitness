<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the subscription plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plans = SubscriptionPlan::all(); // Fetch all subscription plans
        return view('plans.show', compact('plans'));
    }

    /**
     * Process subscription for a specific plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $planId
     * @return \Illuminate\Http\RedirectResponse
     */


     public function processSubscription(Request $request, $planId)
     {
         $user = Auth::user(); // Get the authenticated user
         $plan = SubscriptionPlan::find($planId);

         if (!$plan) {
             return redirect()->route('dashboard')->with('error', 'Invalid subscription plan.');
         }

         // Attempt to find the user again in case the initial `save()` failed
         $user = User::find($user->id);

         // If user already has a subscription, update it
         if ($user->subscription_plan) {
             $user->subscription_plan = $plan->name;
         } else {
             // Assign a new subscription plan
             $user->subscription_plan = $plan->name;
         }

         // Attempt to save the model
         if (!$user->save()) {
             // If it fails again, redirect with an error
             return redirect()->route('dashboard')->with('error', 'Unable to save subscription plan. Please try again.');
         }

         $user = User::all();

         return redirect()->route('dashboard')->with('success', "You've subscribed to the {$plan->name} plan!");
     }

}


