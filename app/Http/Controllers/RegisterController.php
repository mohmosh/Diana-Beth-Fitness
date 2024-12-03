<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    // User registration and creating users
    public function register(RegisterUserRequest $request)
    {

        try {
             // Validate the request, including password confirmation
        $validatedData = $request->validated();

        // dd($validatedData);

        // Automatically hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

            // // Create the new user with validated data
            $user = User::create($validatedData);

            if ($user) {
                Log::info('User Created:', $user->toArray());
            } else {
                Log::error('Failed to create user.');
                return Redirect::back()->with('error', 'Failed to create user.');
            }

        //   $email = 'moshwanjiku@gmail.com';
        //   $user = User::where('email', $email)->first();



            try {
                // Attempt to send the email verification notification
                $user->sendEmailVerificationNotification();

                // Log successful email send
                Log::info('Verification email sent to user: ' . $user->email);


            } catch (\Exception $e) {
                // Log error if the email fails to send
                // dd($e->getMessage());
                Log::error('Error sending verification email: ' . $e->getMessage());
                return Redirect::back()->with('error', 'Failed to send verification email.');
            }

            // Authenticate the user
            auth()->login($user);

            // Redirect to the user dashboard or any other route
            return redirect()->route('verify')->with('success', 'Welcome to your dashboard! Please verify your email.');



        } catch (\Exception $e) {
            // Handle any errors by returning an error message
            Log::error('Registration Error: ' . $e->getMessage());

            return Redirect::back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}

