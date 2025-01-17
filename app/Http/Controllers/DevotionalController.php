<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;

class DevotionalController extends Controller
{
    public function index()
    {
        $devotionals = Devotional::paginate(10);

        return view('adminTwo.viewDevotionals', compact('devotionals'));
    }

    public function usersDevotionals()
    {
        $user = Auth::user();

        if ($user) {
            // Fetch the user's subscription type and level
            $plan = $user->subscription ? $user->subscription->plan : null;
            $userSubscriptionType = $plan ? $plan->subscription_type : null;

            // Retrieve devotionals based on subscription type and level
            $devotionals = Devotional::when($userSubscriptionType, function ($query) use ($userSubscriptionType) {
                $query->where('subscription_type', $userSubscriptionType);
            })
            ->where(function ($query) use ($user) {
                // Include devotionals that are available at the user's level or those without level requirements
                $query->where('level_required', '<=', $user->level)
                      ->orWhereNull('level_required');
            })
            ->get();
        } else {
            // For unauthenticated users, fetch devotionals with subscription_type of 'free_trial' or 'challenges'
            $devotionals = Devotional::whereIn('subscription_type', ['free_trial', 'challenges'])
                                     ->orWhere('subscription_type', 'free_trial')
                                     ->get();
        }

        return view('user.devotionals.index', compact('devotionals'));
    }



    public function create()
    {
        return view('adminTwo.uploadDevotional');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subscription_type' => 'nullable|in:personal_training,build_his_temple,free_trial,challenge',
            'level' => 'nullable|integer|min:1',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ], [
            'title.required' => 'The title is mandatory.',
            'content.required' => 'Content cannot be empty.',
            'document.mimes' => 'Only PDF, DOC, DOCX, and TXT files are allowed.',
        ]);


        $documentPath = null;
        $documentContent = null;

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
            $extension = $request->file('document')->getClientOriginalExtension();

            try {
                if ($extension === 'txt') {
                    $documentContent = file_get_contents(storage_path('app/public/' . $documentPath));
                }

                if (in_array($extension, ['docx', 'doc'])) {
                    $phpWord = IOFactory::load(storage_path('app/public/' . $documentPath));
                    $text = '';

                    foreach ($phpWord->getSections() as $section) {
                        foreach ($section->getElements() as $element) {
                            if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                foreach ($element->getElements() as $textElement) {
                                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                        $text .= $textElement->getText();
                                    }
                                }
                            } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                                $text .= $element->getText();
                            }
                        }
                    }

                    $documentContent = $text;
                }
            } catch (\Exception $e) {
                Log::error('Error processing document: ' . $e->getMessage());
            }
        }

        Devotional::create([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
            'document_path' => $documentPath,
            'document_content' => $documentContent,
            'uploaded_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.viewDevotionals')->with('success', 'Devotional created successfully.');
    }

    public function edit($id)
    {
        $devotional = Devotional::findOrFail($id);
        $plans = Plan::all();
        return view('adminTwo.editDevotionals', compact('devotional', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subscription_type' => 'in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
        ], [
            'title.required' => 'The title is mandatory.',
            'content.required' => 'Content cannot be empty.',
        ]);

        $devotional = Devotional::findOrFail($id);
        $devotional->update([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.viewDevotionals')->with('success', 'Devotional updated successfully.');
    }

    public function destroy($id)
    {
        $devotional = Devotional::findOrFail($id);
        $devotional->delete();

        return redirect()->route('admin.viewDevotionals')->with('success', 'Devotional deleted successfully.');
    }
}
