<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verifying their email address.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';



    public function verify(Request $request, $id, $hash)
    {
        Log::info("Email verification attempt for ID: " . $id);

        // Fetch the user
        $user = User::find($id);

        if (!$user) {
            Log::error("User not found for ID: " . $id);
            return redirect('/')->with('error', 'User not found.');
        }

        // Check hash
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            Log::error("Hash mismatch for user ID: " . $id);
            return redirect('/')->with('error', 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath())->with('success', 'Your email is already verified.');
        }

        // Mark email as verified
        $user->markEmailAsVerified();

        event(new Verified($user));

        // Log in the user after successful verification
        Auth::login($user);

        Log::info("Email verified successfully for ID: " . $id);

        return redirect('user/dashboard')->with('success', 'Your email has been verified! Welcome to your dashboard.');
    }
}
