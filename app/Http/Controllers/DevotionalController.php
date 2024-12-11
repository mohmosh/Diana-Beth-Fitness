<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use Illuminate\Http\Request;

class DevotionalController extends Controller
{
    public function index()
    {
        // Fetch all devotionals from the database
        $devotionals = Devotional::all();

        // dd($devotionals);


        // Return the view with the data
        return view('adminTwo.viewDevotionals', compact('devotionals'));

    }

        // Devotional
        public function uploadDevotional()
        {
            return view('adminTwo.uploadDevotional');
        }

        public function storeDevotional(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            Devotional::create([
                'title' => $request->title,
                'content' => $request->content,
                'uploaded_by' => auth()->id(),
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Devotional uploaded successfully.');
        }

}
