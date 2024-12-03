<?php

// app/Http/Controllers/PasswordResetController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = Password::sendResetLink($request->only('email'));


        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', 'We have e-mailed your password reset link!')
            : back()->withErrors(['email' => 'We could not find a user with that e-mail address.']);

    }

    public function reset(Request $request)
    {
        dd($request->all());

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);



        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });


        dd($response);

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login.form')->with('status', 'Your password has been reset!')
            : back()->withErrors(['email' => 'The password reset link is invalid or expired.']);
    }











}
//     // Display the password reset request form
//     public function showLinkRequestForm()
//     {
//         return view('auth.passwords.email');
//     }

//     // Handle the submission of the email for password reset
//     public function sendResetLinkEmail(Request $request)
//     {
//         $request->validate(['email' => 'required|email|exists:users,email']);

//         // Send password reset link
//         $status = Password::sendResetLink(
//             $request->only('email')
//         );

//         return $status === Password::RESET_LINK_SENT
//             ? back()->with('status', __($status))
//             : back()->withErrors(['email' => __($status)]);
//     }

//     // Show the password reset form
//     public function showResetForm(Request $request, $token = null)
//     {
//         return view('auth.passwords.reset')->with(
//             ['token' => $token, 'email' => $request->email]
//         );
//     }

//     // Handle password reset form submission
//     public function reset(Request $request)
//     {
//         // Validate the password reset form
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|confirmed|min:8',
//             'token' => 'required'
//         ]);

//         // Reset the user's password
//         $status = Password::reset(
//             $request->only('email', 'password', 'password_confirmation', 'token'),
//             function ($user, $password) {
//                 $user->forceFill([
//                     'password' => Hash::make($password)
//                 ])->save();

//                 // Fire the password reset event
//                 event(new PasswordReset($user));
//             }
//         );

//         return $status == Password::PASSWORD_RESET
//             ? redirect()->route('login')->with('status', 'Password has been reset!')
//             : back()->withErrors(['email' => [__($status)]]);
//     }
// }

