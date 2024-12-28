<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $user = Auth::user();



        logger()->info('User Data: ', ['user' => $user]);
        logger()->info('Plans Data: ', ['plans' => $plans]);

        return view('plans.index', compact('plans', 'user'));
    }


    public function show($id)
    {
        // Fetch the plan by  ID
        $plan = Plan::find($id);

        if (!$plan) {
            abort(404, 'Plan not found');
        }

        return view('plans.show', compact('plan'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',

        ]);

        Plan::create($request->all());

        return redirect()->route('plans.index')->with('success', 'Subscription plan created successfully.');
    }
}
