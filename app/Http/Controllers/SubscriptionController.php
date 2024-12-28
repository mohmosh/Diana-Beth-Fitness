<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    public function index()

    {
        $personalTrainingPlans = Plan::where('subscription_type', 'personal_training')->get();

        $buildHisTemplePlans = Plan::where('subscription_type', 'build_his_temple')->get();

        // dd($personalTrainingPlans, $buildHisTemplePlans);

        // Pass the data to the view

        return view('subscriptions.index', compact('personalTrainingPlans', 'buildHisTemplePlans'));
    }


    public function store(Request $request)
    {
        dd($request->all()); 

        // Validate the request
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        // Check if the user is already logged in
        $user = Auth::user();

                // dd($user);


        // If the user is not logged in, handle new user registration
        if (!$user) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Automatically log in the new user
            Auth::login($user);
        }

        // Retrieve the plan
        $plan = Plan::find($request->plan_id);

        // dd($plan);

        if (!$plan) {
            return redirect()->back()->with('error', 'The selected plan does not exist.');
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

        // Redirect based on plan type
        // Redirect to the appropriate dashboard
        if ($plan->subscription_type === 'personal_training') {

            dd('Redirecting to Personal Training Dashboard');

            return redirect()->route('videos.personalTraining')

                ->with('success', 'You have successfully subscribed to the Personal Training plan.');
        } elseif ($plan->subscription_type === 'build_his_temple') {

            dd('Redirecting to Build His Temple Dashboard');

            return redirect()->route('videos.buildHisTemple')
                ->with('success', 'You have successfully subscribed to the Build His Temple plan.');
        }


        // Fallback
        return redirect()->back()->with('error', 'There was an error processing your subscription. Please try again.');
    }



    // Handle video display based on the user's current level
    public function showBuildHisTempleVideos()
    {
        $user = Auth::user();

        // Retrieve videos for the user's current level or below
        $videos = Video::where('subscription_type', 'build_his_temple')
            ->where('level', '<=', $user->level)
            ->get();

        $progress = $this->calculateLevelProgress($user);

        return view('videos.buildHisTemple', compact('videos', 'user', 'progress'));
    }




    private function calculateLevelProgress($user)
    {
        // Calculate progress based on the number of completed videos
        $totalVideos = Video::where('subscription_type', 'build_his_temple')->count();

        $completedVideos = Video::where('level', '<=', $user->level)
            ->where('subscription_type', 'build_his_temple')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();

        // Calculate percentage progress
        if ($totalVideos > 0) {
            return round(($completedVideos / $totalVideos) * 100);
        }

        return 0; // Return 0 if no videos are found
    }



    public function upgradeLevel()
    {
        $user = Auth::user();

        dd($user);

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
        $plan = Plan::findOrFail($planId);

        // dd($plan);

        return view('subscriptions.form', compact('plan'));
    }
}
