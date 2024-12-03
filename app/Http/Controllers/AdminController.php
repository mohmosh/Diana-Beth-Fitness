<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // View All Users
    public function viewUsers()
    {
        $users = User::where('role_id', 2)->get(); // Fetch only users, not admins
        return view('admin.users', compact('users'));
    }

    // Add Exercise
    public function addExercise()
    {
        return view('admin.addExercise');
    }

    // Store Exercise
//     public function storeExercise(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'nullable|string',
//         ]);

//         Exercise::create($request->all()); // Assuming Exercise model exists
//         return redirect()->route('admin.dashboard')->with('success', 'Exercise added successfully.');
//     }
}
