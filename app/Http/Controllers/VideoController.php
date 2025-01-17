<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // Display all uploaded videos (Admin side)
    public function index()
    {
        $videos = Video::all();

        return view('adminTwo.viewVideos', compact('videos'));
    }

    // Display videos for users based on subscription type and level



    public function usersVideos()
    {
        $user = Auth::user();

        if (!$user) {
            // If user is not logged in, show available plans
            $plans = Plan::all(); // Or any other logic to show available plans
            return view('subscriptions.index', compact('plans'));
        }

        // Ensure the user has a valid subscription
        if ($user->subscription) {

            $plan = $user->subscription->plan; // Fetch the user's current plan

            if ($plan->subscription_type === 'personal_training') {
                // Fetch Personal Training videos
                $videos = Video::where('subscription_type', 'personal_training')->get();

                return view('dashboard.personalTraining', compact('videos', 'user'));
            } elseif ($plan->subscription_type === 'build_his_temple') {
                // Get Build His Temple videos based on user's current level
                $videos = Video::where('subscription_type', 'build_his_temple')
                    ->where('level', '<=', $user->current_level) // Ensure level filter is applied
                    ->get();

                Log::info('Fetched Videos for Build His Temple: ', $videos->toArray());

                return view('dashboard.buildHisTemple', compact('videos', 'user'));
            } else {
                return redirect()->route('plans.index')->with('warning', 'Please subscribe to a valid plan to access videos.');
            }
        } else {
            // No active subscription found, prompt to subscribe
            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }
    }

    // Method to show free trial videos
    public function showFreeTrialVideos()
    {
        $user = Auth::user();

        // If the user is not logged in, show the free trial view
        if (!$user) {
            return view('dashboard.freeTrial');
        }

        // If the user has no active subscription
        if (!$user->subscription) {
            $freePlans = Plan::whereIn('subscription_type', ['free_trial', 'challenges'])->get();

            if ($freePlans->isNotEmpty()) {
                return view('subscriptions.free', compact('freePlans'));
            }

            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }

        // Fetch the user's current plan
        $plan = $user->subscription->plan;

        // Check if the plan is 'free_trial'
        if ($plan->subscription_type === 'free_trial') {
            $videos = Video::where('subscription_type', 'free_trial')->get();
            return view('user.videos.freeTrial', compact('videos', 'user'));
        }

        // Handle other subscription types (e.g., challenges, etc.)
        return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
    }

    // Method to show challenges videos
    public function showChallengesVideos()
    {
        $user = Auth::user();

        // If the user is not logged in, show the challenges view
        if (!$user) {
            return view('dashboard.challenges');
        }

        // If the user has no active subscription
        if (!$user->subscription) {
            $freePlans = Plan::whereIn('subscription_type', ['free_trial', 'challenges'])->get();

            if ($freePlans->isNotEmpty()) {
                return view('subscriptions.free', compact('freePlans'));
            }

            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }

        // Fetch the user's current plan
        $plan = $user->subscription->plan;

        // Check if the plan is 'challenges'
        if ($plan->subscription_type === 'challenges') {
            $videos = Video::where('subscription_type', 'challenges')->get();
            return view('user.videos.challenges', compact('videos', 'user'));
        }

        // Handle other subscription types (e.g., free_trial, etc.)
        return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
    }



    // Admin side - Display the upload form
    public function create()
    {
        return view('adminTwo.uploadVideo');
    }

    // Admin side - Handle video upload
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mkv,avi,flv',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'subscription_type' => 'nullable|in:personal_training,build_his_temple,free_trial,challenge',
            'level' => 'nullable|integer|min:1',  // This is only needed for Build His Temple
        ]);

        // Handle the video upload (store in the public disk)
        $path = $request->file('video')->store('videos', 'public');

        // Save video details to the database
        Video::create([
            'title' => $request->title,
            'path' => $path,
            'description' => $request->description,
            'url' => $request->url,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level // Level is set only if the video belongs to "Build His Temple"
        ]);

        // Fetch all videos after upload and display them
        $videos = Video::all();

        return view('adminTwo.viewVideos', compact('videos'));
    }

    // View for Personal Training Videos

    public function personalTraining()
    {
        $user = Auth::user();

        // Check if the user has a subscription to the personal training plan
        if (!$user || !$user->plan || $user->plan->subscription_type !== 'personal_training') {
            return redirect()->route('subscriptions.index')->with('error', 'Please subscribe to the Personal Training plan.');
        }

        // Fetch the videos associated with personal training
        $videos = Video::where('subscription_type', 'personal_training')->get();

        // Pass videos to the view
        return view('dashboard.personalTraining', compact('videos'));
    }



    // View for Build His Temple Videos
    public function buildHisTemple()
    {
        $user = Auth::user();

        // Ensure user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this content.');
        }

        // Ensure user has valid subscription
        if ($user->plan_id !== 2) {
            return redirect()->route('subscriptions.index')->with('error', 'You need to subscribe to "Build His Temple" to view these videos.');
        }

        // Fetch videos for "Build His Temple" up to the user's current level
        $videos = Video::where('subscription_type', 'build_his_temple')
            ->where('level', '<=', $user->current_level)
            ->get();

        // Debugging: Check if videos are retrieved
        if ($videos->isEmpty()) {
            Log::info('No videos found for Build His Temple.', ['user_level' => $user->current_level]);
        } else {
            Log::info('Fetched videos for Build His Temple.', ['videos' => $videos]);
        }

        // Pass the data to the view
        return view('dashboard.buildHisTemple', compact('videos', 'user'));
    }




    // Edit video form
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('adminTwo.editVideo', compact('video'));
    }

    // Update video details
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'subscription_type' => 'required|in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',

        ]);

        $video = Video::findOrFail($id);

        // Update the video
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level
        ]);

        return redirect()->route('admin.viewVideos')->with('success', 'Video updated successfully!');
    }

    // Delete video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        // Get the relative path from the database (e.g., 'videos/video1.mp4')
        $filePath = 'public/' . $video->path;

        // Debugging: Log the full file path to ensure it is correct
        Log::info("Deleting file: " . $filePath);

        // Check if the file exists before attempting to delete it
        if (Storage::exists($filePath)) {
            // Delete the video file
            Storage::delete($filePath);
        } else {
            // If file doesn't exist, log an error
            Log::error("File not found: " . $filePath);
        }

        // Delete the video record from the database
        $video->delete();

        // Redirect back with success message
        return redirect()->route('admin.viewVideos')->with('success', 'Video deleted successfully!');
    }







    // Request for level jump (only for "Build His Temple" users)
    public function requestLevelJump(Request $request)
    {
        $user = Auth::user();

        // Ensure the user is in the "Build His Temple" plan
        if ($user->plan_id !== 2) {
            return redirect()->route('videos.buildHisTemple')->with('error', 'Only "Build His Temple" users can request a level jump.');
        }

        // Check if the user has already reached the maximum level (e.g., level 3)
        if ($user->level >= 3) {
            return redirect()->route('videos.buildHisTemple')->with('error', 'You have already reached the maximum level.');
        }

        // Advance the user to the next level
        $user->level += 1; // Increment the user's level
        $user->save();

        // Redirect to the Build His Temple dashboard with a success message
        return redirect()->route('videos.buildHisTemple')->with('success', 'You have advanced to the next level.');
    }
}
