<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email, 
        ]);
    }

    /**
     * Handle the password reset process.
     */

    public function reset(Request $request)
{
    // Validate the request
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(6)],
        'token' => 'required',
    ]);

    // Reset the password
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    // Check response and redirect
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', 'Your password has been updated successfully! Please login.')
        : back()->withErrors(['email' => __($status)]);
}

}
