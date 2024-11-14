<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();

        return view('plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|regex:/^[A-Z]{3}-\d{3}$/|string|unique:plans',
            'description' => 'nullable|string',
            'term' => 'required|in:monthly,yearly,lifetime',
            'membership_fee' => 'required|numeric',
            'currency' => 'required|string|in:USD,MYR'
        ]);

        $plan = Plan::create([
            'name' => $validated_data['name'],
            'code' => $validated_data['code'],
            'description' => $validated_data['description'],
            'term' => $validated_data['term'],
            'currency' => $validated_data['currency'],
            'membership_fee' => $validated_data['membership_fee']
        ]);

        return redirect()->route('plan.index')->with('success','Plan has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|regex:/^[A-Z]{3}-\d{3}$/|string|unique:plans,code,' . $plan->id,
            'description' => 'nullable|string',
            'term' => 'required|in:monthly,yearly,lifetime',
            'membership_fee' => 'required|numeric',
            'currency' => 'required|string|in:USD,MYR'
        ]);    
    
        $plan->update( $validated_data );

        return redirect()->route('plan.index')->with('success','Plan has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
