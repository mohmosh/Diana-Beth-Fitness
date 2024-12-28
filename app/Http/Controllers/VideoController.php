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
            // Fetch available plans if the user is not authenticated
            $plans = Plan::all(); // Or any other logic to show available plans
            return view('subscriptions.index', compact('plans'));
        }

        // Check if the user has a valid subscription
        if ($user->plan_id === 1) { // Personal Training
            $videos = Video::where('subscription_type', 'personal_training')->get();
            return view('dashboard.personalTraining', compact('videos'));
        } elseif ($user->plan_id === 2) { // Build His Temple
            // Get videos based on user's current level
            $videos = Video::where('subscription_type', 'build_his_temple')
                           ->where('level', '<=', $user->current_level) // Ensure level filter is applied
                           ->get();

            Log::info('Fetched Videos for Build His Temple: ', $videos->toArray());

            return view('dashboard.buildHisTemple', compact('videos', 'user'));
        } else {
            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }
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
            'subscription_type' => 'required|in:personal_training,build_his_temple',
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

        $videos = Video::where('subscription_type', 'personal_training')->get();

        return view('dashboard.personalTraining', compact('videos', 'user'));
    }

    // View for Build His Temple Videos
    public function buildHisTemple()
    {
        $user = Auth::user();

        // Ensure user has valid subscription
        if ($user->plan_id !== 2) {
            return redirect()->route('subscriptions.index')->with('error', 'You need to subscribe to "Build His Temple" to view these videos.');
        }

        // Fetch videos for "Build His Temple" up to the user's current level
        $videos = Video::where('subscription_type', 'build_his_temple')
            ->where('level', '<=', $user->current_level)
            ->get();

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

    if ($user->plan_id !== 2) {
        return redirect()->route('videos.buildHisTemple')->with('error', 'Only "Build His Temple" users can request a level jump.');
    }

    $user->level_jump_requested = true;
    $user->next_level = $user->current_level + 1; // Requesting the next level
    $user->save();

    return redirect()->route('videos.buildHisTemple')->with('success', 'Level jump requested. Awaiting admin approval.');
}

}
