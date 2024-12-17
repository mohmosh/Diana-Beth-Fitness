<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\Video;
use App\Models\Testimonial;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the subscription plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        $plans = SubscriptionPlan::all(); // Fetch all subscription plans

        return view('subscriptions.plans', compact('plans', 'user'));
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

        // Update or assign the subscription plan
        $user->subscription_plan = $plan->name;
        $user->save();

        return redirect()->route('dashboard')->with('success', "You've subscribed to the {$plan->name} plan!");
    }

    /**
     * Show content for the Basic subscription plan.
     *
     * @return \Illuminate\View\View
     */
    public function showBasic()
    {
        $user = auth()->user(); // Get the authenticated user

        // $videos = Video::where('subscription_plan', 'Basic')->get(); // Fetch videos for Basic plan

        // return view('subscriptions.basic', compact('user', 'videos'));

        return view('subscriptions.basic', compact('user'));


        // return ('Basic Subscription');

    }

    /**
     * Show content for the Premium subscription plan.
     *
     * @return \Illuminate\View\View
     */
    public function showPremium()
    {
        $user = auth()->user(); // Get the authenticated user
        $videos = Video::all(); // Fetch all videos
        $testimonials = Testimonial::all(); // Fetch all testimonials for Premium users
        $forums = Forum::all(); // Fetch all forums for Premium users


        // return ('Premium Subscription');
        return view('subscriptions.premium', compact('user'));
    }
}
