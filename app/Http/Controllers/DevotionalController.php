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

        $plans = Plan::all();

        $plan = $user->subscription->plan; // Fetch the user's current plan


        // Get the user's subscription type
        $userSubscriptionType = $plan->subscription_type;

        $devotionals = Devotional::when($userSubscriptionType, function($query) use ($userSubscriptionType) {

            return $query->where('subscription_type', $userSubscriptionType);
        })

        ->where(function($query) use ($user) {
            // Allow access to devotionals where the level required is less than or equal to the user's level
            $query->where('level_required', '<=', $user->level)
                  ->orWhereNull('level_required'); // Include devotionals with no level required
        })
        ->get();

        return view('user.devotionals.index', compact('devotionals'));
    }



    public function create()
    {
        return view('adminTwo.uploadDevotional');
    }

    //  Store a new devotional.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subscription_type' => 'nullable|in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',

        ]);

        // handles where to store the documents
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public'); // Store in 'public/documents' directory
        }

        // Create the devotional
        Devotional::create([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
            'document_path' => $documentPath, 
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
