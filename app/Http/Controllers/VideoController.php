<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



class VideoController extends Controller
{
    // Display all uploaded videos (Admin side)
    public function index()
    {
        $videos = Video::all();

        return view('adminTwo.viewVideos', compact('videos'));
    }

    public function indexing()
    {
        $videos = Video::all();

        return view('layouts.dashboard', compact('videos'));
    }


    // Display videos for users based on subscription type and level
    public function usersVideos()
    {
        $user = Auth::user();

        if (!$user) {
            // If user is not logged in, show available plans
            $plans = Plan::all();
            return view('subscriptions.index', compact('plans'));
        }

        // Ensure the user has a valid subscription
        if ($user->subscription) {

            // Fetch the user's progress
            $progress = $user->progress()->get();

            $plan = $user->subscription->plan; // Fetch the user's current plan

            if ($plan->subscription_type === 'personal_training') {

                // Fetch Personal Training videos
                $videos = Video::where('subscription_type', 'personal_training')->get();

                return view('dashboard.personalTraining', compact('videos', 'user', 'progress'));
            } elseif ($plan->subscription_type === 'build_his_temple') {

                // Get Build His Temple videos based on user's current level
                $videos = Video::where('subscription_type', 'build_his_temple')
                    ->where('level', '<=', $user->current_level) // Ensure level filter is applied
                    ->get();

                Log::info('Fetched Videos for Build His Temple: ', $videos->toArray());

                return view('dashboard.buildHisTemple', compact('videos', 'user', 'progress'));
            } elseif ($plan->subscription_type === 'free_trial') {

                $user->free_trial_started_at = now()->subDays(4); // Testing

                // Check if the free trial has expired
                $daysPassed = Carbon::parse($user->free_trial_started_at)->diffInDays(now());

                // Calculate days left for the free trial
                $daysLeft = max(0, 7 - $daysPassed);


                if ($daysLeft <= 0) {
                    return redirect()->route('subscriptions.choose')->with('error', 'Your free trial has expired. Please subscribe to continue.');
                }

                // Fetch Free Trial videos
                $videos = Video::where('subscription_type', 'free_trial')->limit(7)->get();

                // Pass the correct variables to the view
                return view('dashboard.freeTrial', compact('videos', 'user', 'progress', 'daysPassed', 'daysLeft'));
                
            } elseif ($plan->subscription_type === 'challenge') {

                // Fetch Challenge videos
                $videos = Video::where('subscription_type', 'challenge')->get();

                return view('dashboard.challenges', compact('videos', 'user', 'progress'));

            } else {
                return redirect()->route('plans.index')->with('warning', 'Please subscribe to a valid plan to access videos.');
            }
        } else {
            // No active subscription found, prompt to subscribe
            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }
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


    // View for ShowFree Trial Videos

    public function showFreeTrialVideos()
    {
        $user = Auth::user();

        // Temporary testing line: Remove this in production
        $user->free_trial_started_at = now()->subDays(7); // Testing

        // Ensure the user has a free trial subscription
        if ($user->subscription->plan->subscription_type !== 'free_trial') {
            return redirect()->route('subscription.plans')->with('error', 'Access denied.');
        }

        // Calculate days since the free trial started
        $daysPassed = Carbon::parse($user->free_trial_started_at)->diffInDays(Carbon::now());

        // Ensure daysLeft doesn't go negative
        $daysLeft = max(0, 7 - $daysPassed);

        // Redirect if the trial has ended
        if ($daysLeft <= 0) {
            return redirect()->route('subscriptions.choose')->with('error', 'Your free trial has expired. Please subscribe to continue.');
        }

        // Fetch free trial videos (limit 7)
        $videos = Video::where('subscription_type', 'free_trial')->limit(7)->get();

        return view('videos.free_trial', compact('videos', 'daysLeft'));
    }




    // Method to show challenges videos
    public function showChallengesVideos()
    {
        $videos = Video::where('subscription_type', 'challenge')->get();

        return view('dashboard.challenges', compact('videos'));
    }




    // Admin side - Display the upload form
    public function create()
    {
        return view('adminTwo.uploadVideo');
    }



    // Admin side - Handle video upload
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mkv,avi,flv|max:102400', // 100MB max size
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'subscription_type' => 'nullable|in:personal_training,build_his_temple,free_trial,challenge',
            'level' => 'nullable|integer|min:1', // Only for Build His Temple
            // 'devotional_content' => 'nullable|string', // For text-based devotionals
            'devotional_file' => 'nullable|file|mimes:pdf,docx,txt|max:102400' // 100MB max size for file uploads
        ]);

        //

        // Store the video

        if ($request->hasFile('video')) {

            // TODO : Fix naming convention for videos
            $path = $request->file('video')->store('videos', 'public');
        }
        // Save file-based devotional

        if ($request->hasFile('devotional_file')) {

            // TODO : Fix naming convention for devotionals

            $devotional_path = $request->file('devotional_file')->store('devotionals', 'public');
        }

        // dd($devotional_path);


        // Create the video record
        $video = Video::create([
            'title' => $request->title,
            'path' => $path,
            'description' => $request->description,
            'url' => $request->url,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
            'devotional_content' => $request->devotional_content,
            'devotional_file' => $devotional_path
        ]);


        return redirect()->route('admin.viewVideos')->with('success', 'Video uploaded successfully!');
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






    // Method to handle marking video as done
    public function markVideoDone(Request $request)
    {
        $video = Video::findOrFail($request->videoId);

        $user = auth()->user();

        // Update the pivot table to mark the video as watched
        $user->videos()->updateExistingPivot($video->id, ['watched' => true]);

        return response()->json(['success' => true]);
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
