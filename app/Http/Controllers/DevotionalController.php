<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevotionalController extends Controller
{
    public function index()
    {
        $devotionals = Devotional::all();
        return view('adminTwo.viewDevotionals', compact('devotionals'));
    }



    public function usersDevotionals()
    {
        $user = Auth::user();

        $devotionals = Devotional::all();

        $devotionals = Devotional::where('plan_id', $user->subscription_plan_id)
            ->where('level_required', '<=', $user->level)
            ->get();

        return view('user.devotionals.index', compact('devotionals'));
    }



    public function create()
    {
        return view('adminTwo.uploadDevotional');
    }

    //  Store a new devotional.
    public function storeDevotional(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subscription_type' => 'required|in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
        ]);

        // Create the devotional
        Devotional::create([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
            'uploaded_by' => Auth::user()->id,
        ]);

        $devotionals = Devotional::all();

        return view('adminTwo.viewDevotionals', compact('devotionals'));
    }




    public function edit($id)
    {
        $devotional = Devotional::findOrFail($id);
        $plans = Plan::all(); // Fetch all plans for selection
        return view('adminTwo.editDevotionals', compact('devotional', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subscription_type' => 'in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
        ]);

        $devotional = Devotional::findOrFail($id);
        $devotional->update([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level
        ]);

        return redirect()->route('admin.viewDevotionals')->with('success', 'Devotional updated successfully.');
    }

    public function destroy($id)
    {
        $devotional = Devotional::findOrFail($id);
        $devotional->delete();

        return redirect()->route('admin.viewDevotionals')->with('success', 'Devotional deleted successfully.');
    }




    /**
     * Display devotionals for the authenticated user based on their plan and level.
     */
}
