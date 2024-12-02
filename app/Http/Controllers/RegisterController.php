<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    // User registration and creating users
    public function register(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'fitness_goal' => 'nullable|string|max:255',
                'preferences' => 'nullable|string|max:255',
                'password' => 'required|string|min:8|confirmed',
                'role_id' => 'required|exists:roles,id',
            ]);

            // Find the role based on the provided role ID (User or Admin)
            $role = Role::findOrFail($request->role_id);

    ;

            // Create the new user
            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'fitness_goal' => $request->fitness_goal,
                'preferences' => $request->preferences,
                'password' => Hash::make($request->password), // Hash the password
                'role_id' => $role->id,
            ]);

            Log::info('User Created:', $user->toArray());

            // Authenticate user
            auth()->login($user);

            // Redirect to dashboard or login page with a success message
            return redirect()->route('dashboard')->with('success', 'Registration successful. Please login.');

        } catch (\Exception $e) {
            // Handle any errors by returning an error message
            return Redirect::back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Get all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
}

