<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\Language;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $pricingPlans = PricingPlan::orderBy('order')->get();
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plans.index', compact('pricingPlans', 'languages'));
    }

    public function create()
    {
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plans.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'price_en' => 'required|string|max:50',
            'price_az' => 'required|string|max:50',
            'status' => 'boolean'
        ]);

        $pricingPlan = new PricingPlan();
        
        // Set translatable fields
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $pricingPlan->setTranslation('title', $language->lang_code, $request->{"title_{$language->lang_code}"} ?? '');
            $pricingPlan->setTranslation('price', $language->lang_code, $request->{"price_{$language->lang_code}"} ?? '');
        }
        
        $pricingPlan->status = $request->has('status');
        $pricingPlan->order = PricingPlan::max('order') + 1;
        $pricingPlan->save();

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan created successfully.');
    }

    public function show(PricingPlan $pricingPlan)
    {
        return redirect()->route('admin.pricing-plans.index');
    }

    public function edit(PricingPlan $pricingPlan)
    {
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plans.edit', compact('pricingPlan', 'languages'));
    }

    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'price_en' => 'required|string|max:50',
            'price_az' => 'required|string|max:50',
            'status' => 'boolean'
        ]);

        // Update translatable fields
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $pricingPlan->setTranslation('title', $language->lang_code, $request->{"title_{$language->lang_code}"} ?? '');
            $pricingPlan->setTranslation('price', $language->lang_code, $request->{"price_{$language->lang_code}"} ?? '');
        }
        
        $pricingPlan->status = $request->has('status');
        $pricingPlan->save();

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan updated successfully.');
    }

    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->delete();
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'required|integer|exists:pricing_plans,id'
        ]);

        foreach ($request->orders as $index => $id) {
            PricingPlan::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleStatus(PricingPlan $pricingPlan)
    {
        $pricingPlan->status = !$pricingPlan->status;
        $pricingPlan->save();
        
        return response()->json([
            'success' => true,
            'status' => $pricingPlan->status
        ]);
    }
}
