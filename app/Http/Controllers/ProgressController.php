<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    // Display all progress
    public function index()
    {
        $progress = Progress::where('user_id', auth()->id())->get();

        // Format the start_date as 'Y-m-d' if it's not null
        $progress = $progress->map(function ($entry) {
            if ($entry->start_date) {

                $entry->start_date = $entry->start_date->format('Y-m-d');
            }

            return $entry;
        });

        // Pass the progress data to the view
        return view('progress.chart', compact('progress'));
    }



    public function showProgressForm()
    {
        $user = Auth::user();

        $progress = $user->progress()->orderBy('created_at', 'asc')->get();

        return view('progress.track', compact('progress'));
    }


    // Store a new progress record
    public function store(Request $request)
    {
        $request->validate([
            'starting_weight' => 'required|numeric',
            'closing_weight' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        // Create a new progress entry for the authenticated user
        Progress::create([
            'user_id' => auth()->id(),
            'starting_weight' => $request->starting_weight,
            'closing_weight' => $request->closing_weight,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Redirect to the user's dashboard with success message
        return redirect()->route('progress.chart')->with('success', 'Progress added successfully!');
    }


    // Method to fetch all progress entries for the user
    public function showProgress()
    {
        $progress = auth()->user()->progress()->orderBy('start_date', 'asc')->get();

        // Pass the progress data to the view
        return view('progress.chart', compact('progress'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'start_weight' => 'required|numeric',
            'closing_weight' => 'required|numeric',
        ]);

        // Fetch the latest progress entry if ID is missing
        $progress = Auth::user()->progress()->find($id) ?? Auth::user()->progress()->latest()->first();

        if (!$progress) {
            return redirect()->route('user.dashboard')->with('error', 'No progress record found.');
        }

        $progress->update([
            'starting_weight' => $request->start_weight,
            'closing_weight' => $request->closing_weight,
        ]);

        return redirect()->route('progress.chart')->with('success', 'Progress updated successfully!');
    }






    // Edit an existing progress record
    public function edit($id)
    {
        $progress = Progress::findOrFail($id);

        return view('user.progress.edit', compact('progress'));
    }
}
