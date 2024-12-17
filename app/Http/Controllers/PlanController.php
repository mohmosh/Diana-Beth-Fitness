<?php


namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the subscription plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plans = SubscriptionPlan::all(); // Fetch all subscription plans
        return view('plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new subscription plan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created subscription plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        SubscriptionPlan::create($request->all());

        return redirect()->route('plans.index')->with('success', 'Subscription plan created successfully.');
    }

    /**
     * Show the form for editing the specified subscription plan.
     *
     * @param  \App\Models\SubscriptionPlan  $plan
     * @return \Illuminate\View\View
     */
    public function edit(SubscriptionPlan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified subscription plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPlan  $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SubscriptionPlan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $plan->update($request->all());

        // $plan = Plan::all();

        return redirect()->route('plans.index')->with('success', 'Subscription plan updated successfully.');
    }

    /**
     * Remove the specified subscription plan from storage.
     *
     * @param  \App\Models\SubscriptionPlan  $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SubscriptionPlan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Subscription plan deleted successfully.');
    }
}

