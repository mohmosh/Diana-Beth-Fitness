<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Fetch personal training plans
        $personalTrainingPlans = Plan::where('subscription_type', 'personal_training')->get();

        // dd($personalTrainingPlans);

        // Fetch build his temple plans
        $buildHisTemplePlans = Plan::where('subscription_type', 'build_his_temple')->get();

        return view('subscriptions.index', compact('personalTrainingPlans', 'buildHisTemplePlans'));


    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed', // Ensure passwords match
        ]);

        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $request->plan_id;
        $subscription->start_date = now(); // Current date as the start date
        $subscription->end_date = now()->addMonths(1); // For example, 1 month subscription
        $subscription->status = 'active'; // Default status

        if ($subscription->save()) {
            // Subscription saved successfully
//  dd($subscription->plan->subscription_type);

            // Redirect user based on their subscription type
            if ($subscription->plan->subscription_type === 'personal_training') {

                return view('dashboard.personalTraining')->with('success', 'You have successfully subscribed to Personal Training.');

            } elseif ($subscription->plan->subscription_type === 'build_his_temple') {
                return view('dashboard.buildHisTemple')->with('success', 'You have successfully subscribed to Build His Temple.');
            }
        } else {
            // Handle error if subscription creation fails
            return redirect()->back()->with('error', 'There was an error creating your subscription. Please try again.');
        }
    }



    public function showForm($plan)
    {
        $user = Auth::user();

        // dd($user);


        $plan = Plan::findOrFail($plan);
        return view('subscriptions.form', compact('plan', 'user'));
    }




}
