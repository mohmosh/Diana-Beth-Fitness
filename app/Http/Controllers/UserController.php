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



    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }





    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Store new profile picture
            $filename = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_pictures', $filename);
            $user->profile_picture = $filename;
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        // Refresh user session
        Auth::setUser($user);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }






}
