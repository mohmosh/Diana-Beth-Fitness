<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{

    // Display all uploaded videos
    public function index()
    {
        $videos = Video::all();

        //  dd($videos);

        return view('adminTwo.viewVideos', compact('videos'));
    }




    public function usersVideos()
    {
        $user = auth()->user(); // Get the authenticated user
        $videos = collect(); // Initialize an empty collection for videos

        // Check the user's subscription plan and limit content accordingly
        if ($user->plan_id === 1) { // Bronze plan
            $videos = Video::take(2)->get(); // Limit to 2 videos

        } elseif ($user->plan_id === 2) { // Silver plan
            $videos = Video::take(4)->get(); // Limit to 4 videos

        } elseif ($user->plan_id === 3) { // Gold plan
            $videos = Video::all(); // Full access to videos

        } else {
            // If no valid subscription, redirect with a warning
            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access videos.');
        }

        // Pass the filtered videos to the user's view
        return view('user.videos.index', compact('videos'));
    }


    // Admin side
    // Display the upload form
    public function create()
    {
        return view('adminTwo.uploadVideo');
    }

    // Handle the video upload
    public function store(Request $request)
    {
        // dd('here');
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mkv,avi,flv',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'subscription_type' => 'required|in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
        ]);

        // Store the uploaded video file
        $path = $request->file('video')->store('videos', 'public');

        // Save video details to the database
        $video = Video::create([
            'title' => $request->title,
            'path' => $path,
            'description' => $request->description,
            'url' => $request->url,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level
        ]);

        $videos = Video::all();




        // return redirect()->route('adminTwo.dashboard')->with('success', 'Video uploaded successfully.');

        return view('adminTwo.viewVideos', compact('videos'));


        // return view('adminTwo.viewVideos');

    }


    public function personalTraining()
    {
        $user = Auth::user();
        $videos = Video::where('subscription_type', 'personal_training')->get();
        return view('videos.personal_training', compact('videos'));
    }

    public function buildHisTemple()
    {
        $user = Auth::user();
        $videos = Video::where('subscription_type', 'build_his_temple')
            ->where('level', $user->current_level)
            ->get();

        return view('videos.build_his_temple', compact('videos'));
    }

    public function requestLevelJump(Request $request)
    {
        $user = Auth::user();
        if ($user->subscription_type !== 'build_his_temple') {
            return redirect()->route('videos.buildHisTemple')->with('error', 'Only users subscribed to "Build His Temple" can request a level jump.');
        }

        // Admin approval logic (placeholder)
        $user->level_approval = true;
        $user->save();

        return redirect()->route('videos.buildHisTemple')->with('success', 'Level jump requested. Awaiting admin approval.');
    }
}
