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
        return view('adminTwo.plans.create');
    }

    public function plans()
    {
        $plans = Plan::all();


        return view('adminTwo.plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',

        ]);

        Plan::create($request->all());

        return redirect()->route('admin.plans')->with('success', 'Subscription plan created successfully.');
    }

    public function editPlan($id)
    {
        $plan = Plan::findOrFail($id);
        $plans = Plan::all();
        return view('adminTwo.plans.editPlans', compact('plan', 'plans'));
    }

    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'string',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Plan updated successfully.');
    }

    public function destroyPlan($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('admin.plans')->with('success', 'Plan deleted successfully.');
    }
}
