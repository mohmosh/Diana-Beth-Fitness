<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as ValidationValidator;

class PasswordResetController extends Controller
{
    // Display the form to reset the password
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Handle the reset password form submission
    public function reset(Request $request)
    {


        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ],[
            'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'password.required' => 'Please provide a password.',
        'password.confirmed' => 'The password confirmation does not match.',
        'password.min' => 'Password must be at least 6 characters long.',
        'token.required' => 'A token is required to proceed.',
        ]);




        // Attempt to reset the password
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Update the user's password
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();

            }
        );


        // Check if password reset was successful and return response
        if ($response == Password::PASSWORD_RESET) {
            // Success: Redirect to login page with success message
            return redirect()->route('login')->with('status', 'Your password has been reset! You can now log in.');
        } else {
            // Error: Redirect back with an error message
            return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
    }
}





