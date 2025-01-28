<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoProgress;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    public function index()
    {
        $personalTrainingPlans = Plan::where('subscription_type', 'personal_training')->get();

        $buildHisTemplePlans = Plan::where('subscription_type', 'build_his_temple')->get();

        // merge both plans into one array
        $plans = $personalTrainingPlans->merge($buildHisTemplePlans);

        // Pass the merged plans to the view
        return view('subscriptions.index', compact('plans'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        // Check if the user is already logged in
        $user = Auth::user();

        // If the user is not logged in, handle new user registration
        if (!$user) {
            // If the user is not logged in, create a new user
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            // Automatically log in the new user
            Auth::login($user);
        }

        // Retrieve the plan
        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return redirect()->back()->with('error', 'The selected plan does not exist.');
        }

        // Handle trial logic for "Build His Temple" and "Personal Training" plans
        if (in_array($plan->subscription_type, ['build_his_temple', 'personal_training'])) {

            if ($user->on_trial) {
                return redirect()->back()->with('error', 'You are already on a free trial for this plan.');
            }

            // Start the trial for the selected plan
            $user->update([
                'on_trial' => true,
                'trial_start_date' => now(),
                'trial_end_date' => now()->addDays(7),  // Trial period of 7 days
            ]);
        }

        // Create a subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'subscription_type' => $plan->subscription_type,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'status' => 'active',
        ]);

        // Redirect based on plan type - appropriate dashboard
        if ($plan->subscription_type === 'personal_training') {

            // Redirect to Personal Training Dashboard
            return redirect()->route('videos.personalTraining')->with('success', 'You have successfully subscribed to the Personal Training plan.');
            
        } elseif ($plan->subscription_type === 'build_his_temple') {

            // Redirect to Build His Temple Dashboard
            return redirect()->route('videos.buildHisTemple')->with('success', 'You have successfully subscribed to the Build His Temple plan.');
        }

        // Fallback
        return redirect()->back()->with('error', 'There was an error processing your subscription. Please try again.');
    }


    public function showBuildHisTempleVideos()
    {
        $user = Auth::user();

        // Check if the trial is still active
        if ($user->on_trial && $user->trial_end_date->isPast()) {

            // Trial has ended
            $user->update(['on_trial' => false]); // End trial

            return redirect()->route('subscribe')->with('message', 'Your trial has ended. Please subscribe to continue.');
        }

        // Fetch videos based on level and progress
        $videos = Video::where('subscription_type', 'build_his_temple')
            ->where('level', '<=', $user->level)
            ->get()
            ->map(function ($video) use ($user) {
                $video->progress = $video->progress()
                    ->where('user_id', $user->id)
                    ->first();
                return $video;
            });

        return view('user.videos.index', compact('videos'));
    }





    public function showPersonalTrainingWorkouts()
    {
        $user = Auth::user();

        $videos = Video::where('subscription_type', 'personal_training')->get();

        // return view('videos.personalTraining', compact('videos'));

        return view('user.videos.index', compact('videos'));
    }

    public function showFreeTrialVideos()
    {
        $videos = Video::where('subscription_type', 'free_trial')->get();

        return view('user.videos.freeTrial', compact('videos'));
    }


    public function showChallengesVideos()
    {
        $videos = Video::where('subscription_type', 'challenges')->get();

        return view('user.videos.challenges', compact('videos'));
    }







    public function upgradeLevel()
    {
        $user = Auth::user();

        // Check if the user is already at the maximum level
        if ($user->level >= 3) {
            return redirect()->route('videos.buildHisTemple')->with('error', 'You have reached the maximum level.');
        }

        // Upgrade the user's level by 1
        $user->level += 1;
        $user->save();

        // Recalculate the progress after upgrading
        $progress = $this->calculateLevelProgress($user);

        // Redirect back to the videos page and pass the progress variable
        return redirect()->route('videos.buildHisTemple')
            ->with('success', 'You have successfully advanced to the next level.')
            ->with('progress', $progress); // Pass progress here
    }





    public function showForm($planId)
    {
        // $user = Auth::user();

        // dd($user->subscription);

        $plan = Plan::findOrFail($planId);

        // dd($plan);

        return view('subscriptions.form', compact('plan'));
    }
}
