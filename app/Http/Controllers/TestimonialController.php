<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {

        $testimonials = Testimonial::latest()->get();

        return view('testimonials.index', compact('testimonials'));

    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string|max:500',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            ]);

            $testimonial = new Testimonial();
            $testimonial->user_id = auth()->id();
            $testimonial->content = $request->content;

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('testimonials/photos', 'public');
                $testimonial->photo = $path;
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('testimonials/videos', 'public');
                $testimonial->video = $videoPath;
            }

            $testimonial->save();

            // Fetch all testimonials to pass to the view
            $testimonials = Testimonial::all();

            return view('testimonials.index', [
                'success' => 'Testimonial uploaded successfully.',
                'testimonials' => $testimonials,
            ]);
        } catch (\Exception $e) {
            Log::error('Error uploading testimonial: ' . $e->getMessage());

            $testimonials = Testimonial::all();

            return view('testimonials.index', [
                'error' => 'An error occurred while uploading the testimonial. Please try again.',
                'testimonials' => $testimonials,
            ]);
        }
    }





}
