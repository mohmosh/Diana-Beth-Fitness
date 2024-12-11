<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{

     // Display all uploaded videos
     public function index()
     {
         $videos = Video::all();

        //  dd($videos);

        return view('adminTwo.viewVideos', compact('videos'));


     }
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
            'video' => 'required|file|mimes:mp4,mkv,avi,flv'
        ]);

        // Store the uploaded video file
        $path = $request->file('video')->store('videos', 'public');

        // Save video details to the database
        $video = Video::create([
            'title' => $request->title,
            'path' => $path,
        ]);

        $videos = Video::all();

        //  dd($videos);


        // return redirect()->route('adminTwo.dashboard')->with('success', 'Video uploaded successfully.');

        return view('adminTwo.viewVideos', compact('videos'));


        // return view('adminTwo.viewVideos');

    }


}
