<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the workouts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workouts = Workout::all(); // Fetch all workouts, since they are not tied to specific users.

        dd($workouts);

        if ($workouts->isEmpty()) {
            return view('workouts.index')->with('message', 'No workouts available.');
        }
        return view('workouts.index', compact('workouts'));
    }

    /**
     * Display the specified workout.
     *
     * @param  Workout $workout
     * @return \Illuminate\View\View
     */
    public function show(Workout $workout)
    {
        // Check subscription and prompt upgrade if necessary
        $user = auth()->user();
        $plan = $user ? $user->subscription->plan : null; // Check user's plan if authenticated

        if ($plan && $plan->isBasic() && !in_array($workout->id, $user->accessibleWorkouts->pluck('id')->toArray())) {
            return redirect()->route('subscriptions.upgrade')->with('warning', 'Upgrade your subscription to view this workout.');
        }

        return view('workouts.show', compact('workout'));
    }
}
