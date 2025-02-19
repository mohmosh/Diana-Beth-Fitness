<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Progress;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated

        $user = Auth::user();
        // dd($user);

        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch user subscription and progress
        $subscription = $user->subscription; // Ensure relationship is defined in User model


        $subscription = Subscription::all();



        // Pass data to the view
        // dd('niko hapa');
        return view('dashboard.user', compact('user', 'subscription',));
    }



    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pictures'), $filename);

            // Delete old profile picture if exists
            if ($user->profile_picture && File::exists(public_path('uploads/profile_pictures/' . $user->profile_picture))) {
                File::delete(public_path('uploads/profile_pictures/' . $user->profile_picture));
            }

            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function removeProfile()
    {
        $user = auth()->user();

        if ($user->profile_picture && File::exists(public_path('uploads/profile_pictures/' . $user->profile_picture))) {
            File::delete(public_path('uploads/profile_pictures/' . $user->profile_picture));
        }

        $user->profile_picture = null;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture removed successfully.');
    }



}
