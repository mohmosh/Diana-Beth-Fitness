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
        $devotionals = Devotional::all();

        return view('adminTwo.viewDevotionals', compact('devotionals'));
    }



    public function usersDevotionals()
    {
        // Get the authenticated user (if any)
        $user = Auth::user();

        if ($user) {

            $plan = $user->subscription ? $user->subscription->plan : null;

            $userSubscriptionType = $plan ? $plan->subscription_type : null;

            $devotionals = Devotional::when($userSubscriptionType, function ($query) use ($userSubscriptionType) {
                return $query->where('subscription_type', $userSubscriptionType);
            })

            ->where(function ($query) use ($user) {

                // Filter on user's level
                $query->where('level_required', '<=', $user->level)
                      ->orWhereNull('level_required');
            })
            ->get();

        } else {
            // If the user is not logged in, return all devotionals
            $devotionals = Devotional::all();
            // dd($devotionals);

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
            'subscription_type' => 'nullable|in:personal_training,build_his_temple',
            'level' => 'nullable|integer|min:1',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        // Handles where to store the documents
        $documentPath = null;
        $documentContent = null;

        if ($request->hasFile('document')) {
            // Store the document and get its path
            $documentPath = $request->file('document')->store('documents', 'public');
            //  dd($documentPath);

            $extension = $request->file('document')->getClientOriginalExtension();

            // If the file is a text file, read its content
            if ($extension === 'txt') {
                $documentContent = file_get_contents(storage_path('app/public/' . $documentPath));
            }

            // For .docx files, extract text content using PhpWord
            if (in_array($extension, ['docx', 'doc'])) {
                $phpWord = IOFactory::load(storage_path('app/public/' . $documentPath));
                $text = '';

                // Loop through the sections and extract text
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        // Check if the element is a TextRun
                        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                            // Loop through the elements inside the TextRun
                            foreach ($element->getElements() as $textElement) {
                                if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                    $text .= $textElement->getText();
                                }
                            }
                        }
                        // If it's a simple Text element, extract the text
                        if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                            $text .= $element->getText();
                        }
                    }
                }

                $documentContent = $text;
            }
        }

        Log::info('Document path: ', [$documentPath]); // Log the document path


        // Create the devotional
        Devotional::create([
            'title' => $request->title,
            'content' => $request->content,
            'subscription_type' => $request->subscription_type,
            'level' => $request->level,
            'document_path' => $documentPath,
            'document_content' => $documentContent, // Store the extracted content
            'uploaded_by' => Auth::user()->id,
        ]);

        // Get all devotionals to display
        $devotionals = Devotional::all();

        // Return view
        return view('adminTwo.viewDevotionals', compact('devotionals'));
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




}
