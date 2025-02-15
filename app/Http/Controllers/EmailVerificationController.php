<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class EmailVerificationController extends Controller
{
    public function verify($id, $hash)
    {
        Log::info("Verifying email for user ID: $id with hash: $hash");

        // Fetch the user
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            Log::error("User not found with ID: $id");
            return redirect('/')->with('error', 'User not found.');
        }

        // Check if the hash matches
        if (sha1($user->email) !== $hash) {
            Log::error("Hash mismatch for user ID: $id, Expected: " . sha1($user->email));
            return redirect('/')->with('error', 'Invalid verification link.');
        }

        // Mark email as verified
        $user->email_verified_at = now();
        $user->save();

        // Log the user in automatically
        Auth::login($user);

    Log::info("Email verified successfully for user ID: $id");

        return redirect()->route('profile')->with('success', 'Your email has been verified! Welcome to your profile.');
    }

}
