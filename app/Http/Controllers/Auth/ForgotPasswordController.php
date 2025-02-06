<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    // Display the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');


    }

    // Send the password reset link to the user's email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email format and check if it exists in the users table
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We could not find a user with that e-mail address.',
        ]);

        // Attempt to send the reset link
        $response = Password::sendResetLink($request->only('email'));

        // Redirect with success message if the reset link is sent
        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->route('password.request')->with('status', 'We have sent your password reset link to your email!');
        }

        // If unable to send, return back with error message
        return back()->withErrors(['email' => __($response)]);
    }

}



