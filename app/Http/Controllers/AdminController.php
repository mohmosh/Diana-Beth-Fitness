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

    public function approveLevelJump(User $user)
    {
        $user->level_approval = false; // Reset approval
        $user->current_level = $user->current_level + 1; // Or set to specific level
        $user->save();

        return redirect()->back()->with('message', 'Level jump approved.');
    }
}
