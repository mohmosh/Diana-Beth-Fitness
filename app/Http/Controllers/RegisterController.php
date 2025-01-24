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
    public function viewAllUsers()
    {
        $users = User::all();

        dd($users);
    }

    // User registration and creating users
   public function register(RegisterUserRequest $request)
{


    // dd('niko hapa');

    try {
        Log::info('Received registration request', $request->all());

        // Validate the request, including password confirmation
        $validatedData = $request->validated();

        // dd($validatedData);


        Log::info('Validated data', $validatedData);

          // Check if the email already exists
          $existingUser = User::where('email', $validatedData['email'])->first();

          if ($existingUser) {

              Log::error('Email already exists.', ['email' => $validatedData['email']]);
              return Redirect::back()->with('error', 'Email already exists.');
          }


        // Automatically hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the new user with validated data
        $user = User::create($validatedData);

        if (!$user) {
            Log::error('Failed to create user.');
            return Redirect::back()->with('error', 'Failed to create user.');
        }

        Log::info('User created successfully', $user->toArray());

        // Send email verification
        try {

            $user->sendEmailVerificationNotification();
            Log::info('Verification email sent to user: ' . $user->email);

        } catch (\Exception $e) {

            // dd($e->getMessage());


            Log::error('Error sending verification email: ' . $e->getMessage());

            return Redirect::back()->with('error', 'Failed to send verification email.');
        }


        // Redirect to a confirmation page with a success message
        return redirect()->route('email.confirmation')

            ->with('success', 'Subscription Successful!! A confirmation email has been sent to your email address. Please verify your email to access your dashboard.');

    } catch (\Exception $e) {



        Log::error('Registration error', ['message' => $e->getMessage()]);

dd($e->getMessage());

        return Redirect::back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

}
