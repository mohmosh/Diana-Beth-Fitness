<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\UserContent;
use App\Models\User;


class AdminController extends Controller
{
    // Display the admin dashboard
    public function dashboard()
    {
        $mediaFiles = Media::orderBy('created_at', 'desc')->get(); // Fetch all media
        $mediaFiles = Media::orderBy('created_at', 'desc')->paginate(5); // 10 items per page

        return view('adminTwo.dashboard', compact('mediaFiles'));

        // return view('adminTwo.dashboard');
    }






    // Display pending user content
    public function getPendingContent()
    {
        $pendingContent = UserContent::where('status', 'pending')->get();
        return view('admin.pendingContent', compact('pendingContent'));
    }

    // Approve user content
    public function approveContent($id)
    {
        $content = UserContent::findOrFail($id);
        $content->status = 'approved';
        $content->save();

        return redirect()->back()->with('success', 'Content approved successfully.');
    }

    // Reject user content
    public function rejectContent($id)
    {
        $content = UserContent::findOrFail($id);
        $content->status = 'rejected';
        $content->save();

        return redirect()->back()->with('success', 'Content rejected successfully.');
    }

    public function viewLevelJumpRequests()
    {
        // Get all users who requested a level jump
        $users = User::where('level_jump_requested', true)->get();
        return view('admin.levelJumpRequests', compact('users'));
    }

    public function approveLevelJump(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Approve the level jump
        $user->level_jump_approved = true;
        $user->current_level = $user->next_level; // Move user to the requested level
        $user->level_jump_requested = false;
        $user->next_level = null;
        $user->save();

        return redirect()->route('admin.levelJumpRequests')->with('success', 'Level jump approved successfully!');
    }

    public function rejectLevelJump(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Reject the level jump
        $user->level_jump_approved = false;
        $user->level_jump_requested = false;
        $user->next_level = null;
        $user->save();

        return redirect()->route('admin.levelJumpRequests')->with('success', 'Level jump rejected successfully.');
    }

    

}
