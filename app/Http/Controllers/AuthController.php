<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

     // Showing the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login Logic
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed
            $user = Auth::user();
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
            ], 200);
        }

        // Authentication failed
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }

    // Content Page
    public function fitnessContent()
        {
        return view('fitness');
        }


     // Logout logic
    public function logout()
        {
            Auth::logout();
            return redirect()->route('login.form')->with('success', 'You have logged out.');
        }


}
