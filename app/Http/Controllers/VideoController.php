<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;
use PhpOffice\PhpWord\Writer\HTML;
use HTMLPurifier;
use HTMLPurifier_Config;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Jobs\CompressVideo;



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

    public function showDevotional($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.devotionals.show', compact('video'));
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
        if ($user->subscriptions) {

            // Fetch the user's progress
            $progress = $user->progress()->get();
            $subs = auth()->user()->subscriptions;

            $all_plans = Plan::all();

            $plans = $all_plans->filter(function ($plan) use ($subs) {
                return $subs->contains(function ($sub) use ($plan) {
                    return (($sub->plan_id === $plan->id) && ($sub->user_id === auth()->user()->id));
                });
            });

            $unsub_plans = $all_plans->diff($plans);

            $videos = Video::all();

            $videos = $videos->filter(function ($aItem) use ($plans) {
                return $plans->contains(function ($bItem) use ($aItem) {
                    return $aItem->plan_id === $bItem->id;
                });
            });

            // dd($videos);
            return view('dashboard.buildHisTemple', compact('videos', 'user', 'progress', 'plans', 'unsub_plans'));


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
        $plans = Plan::all();
        return view('adminTwo.uploadVideo', compact('plans'));
    }


    // Admin side - Handle the video upload finally.

    public function store(Request $request)
    {

        Log::info("Storing the video");
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string',
            'plan_id' => 'nullable',
            'url' => 'nullable|url|max:255',
            'subscription_type' => 'nullable|in:personal_training,build_his_temple,free_trial,challenge',
            'level' => 'nullable|integer|min:1',
            'devotional_file' => 'nullable|file|mimes:pdf,docx,doc,txt|max:102400'
        ]);

        // Check what the subscription type is 

        $devotionalPath = null;
        $devotionalContent = null;

        // Handle devotional file if uploaded
        if ($request->hasFile('devotional_file')) {
            $devotionalPath = $request->file('devotional_file')->store('devotionals', 'public');
            $extension = $request->file('devotional_file')->getClientOriginalExtension();
            $fullPath = storage_path('app/public/' . $devotionalPath);

            try {
                if ($extension === 'txt') {
                    $text = file_get_contents($fullPath);
                    $devotionalContent = $text;
                }

                if (in_array($extension, ['docx', 'doc'])) {
                    $phpWord = IOFactory::load($fullPath);

                    $text = '';
                    foreach ($phpWord->getSections() as $section) {
                        foreach ($section->getElements() as $element) {
                            if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                foreach ($element->getElements() as $textElement) {
                                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                        $text .= $textElement->getText();
                                    }
                                }
                            } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                                $text .= $element->getText();
                            }
                        }
                    }

                    $devotionalContent = $text;
                }

                // Purify HTML content if any
                if ($devotionalContent) {
                    $config = HTMLPurifier_Config::createDefault();
                    $purifier = new HTMLPurifier($config);
                    $devotionalContent = $purifier->purify(nl2br(e($devotionalContent)));
                }
            } catch (\Exception $e) {
                Log::error('Error processing devotional file: ' . $e->getMessage());
            }
        }

        $plan = Plan::where('id', $request->plan_id)->first();

        // Dispatch compression + DB save
        $data = [
            'title' => $request->title,
            'plan_id' => $request->plan_id,
            'url' => $request->url,
            'subscription_type' => $plan->subscription_type ?? 'default',
            'level' => $request->level,
            'video' => $request->video,
            'devotional_file' => $devotionalPath,
            'devotional_content' => $devotionalContent
        ];

        // dd($data);

        Log::info("Calling the compress job,not compressing for now,will set it up in the server");

        CompressVideo::dispatch($data);

        return redirect()->route('admin.viewVideos')->with('success', 'Your video is ready.');
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

    public function upload(Request $request)
    {
        try {
            $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

            if ($receiver->isUploaded()) {
                $save = $receiver->receive();

                if ($save->isFinished()) {
                    $file = $save->getFile();

                    $path = $file->storeAs("videos/full", uniqid() . '.' . $file->getClientOriginalExtension(), 'public');

                    // Dispatch to queue for compression
                    // CompressVideo::dispatch($path);

                    return response()->json([
                        'done' => true,
                        'path' => $path
                    ]);
                }

                $handler = $save->handler();
                return response()->json([
                    "done" => false,
                    "percentage" => $handler->getPercentageDone(),
                ]);
            }

            return response()->json(['error' => 'Upload failed'], 400);
        } catch (\Throwable $e) {
            Log::error("Chunk upload error: " . $e->getMessage());

            return response()->json([
                'error' => 'An error occurred during upload.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
