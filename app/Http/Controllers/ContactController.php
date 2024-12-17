<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Show the contact form
    public function showForm()
    {
        return view('partials.contact');
    }

    public function submit(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to the database
        Contact::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

