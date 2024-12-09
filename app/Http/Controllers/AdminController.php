<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\UserContent;

class AdminController extends Controller
{
    // Display the admin dashboard
    public function dashboard()
    {
        $mediaFiles = Media::orderBy('created_at', 'desc')->get(); // Fetch all media
        $mediaFiles = Media::orderBy('created_at', 'desc')->paginate(5); // 10 items per page

        return view('admin.dashboard', compact('mediaFiles'));
    }


    // Show the form for uploading media
    public function showUploadMedia()
    {
        return view('admin.uploadMedia');
    }

    // Handle media upload
    public function uploadMedia(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4,mkv|max:10240',
        ]);

        $path = $request->file('media')->store('uploads', 'public');

        Media::create([
            'path' => $path,
            'type' => $request->file('media')->getMimeType(),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Media uploaded successfully.');
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
}



