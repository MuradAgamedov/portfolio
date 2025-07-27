<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\PricingPlanFeature;
use App\Models\Language;
use Illuminate\Http\Request;

class PricingPlanFeatureController extends Controller
{
    public function index(PricingPlan $pricingPlan)
    {
        $features = $pricingPlan->features()->orderBy('order')->get();
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plan-features.index', compact('pricingPlan', 'features', 'languages'));
    }

    public function create(PricingPlan $pricingPlan)
    {
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plan-features.create', compact('pricingPlan', 'languages'));
    }

    public function store(Request $request, PricingPlan $pricingPlan)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
        ]);

        $feature = new PricingPlanFeature();
        $feature->pricing_plan_id = $pricingPlan->id;
        
        // Set translatable fields
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $feature->setTranslation('title', $language->lang_code, $request->{"title_{$language->lang_code}"} ?? '');
        }
        
        $feature->status = $request->has('status');
        $feature->order = $pricingPlan->features()->max('order') + 1;
        $feature->save();

        return redirect()->route('admin.pricing-plans.features.index', $pricingPlan)->with('success', 'Feature created successfully.');
    }

    public function show(PricingPlan $pricingPlan, PricingPlanFeature $feature)
    {
        return redirect()->route('admin.pricing-plans.features.index', $pricingPlan);
    }

    public function edit(PricingPlan $pricingPlan, PricingPlanFeature $feature)
    {
        $languages = Language::orderBy('order')->get();
        return view('admin.pricing-plan-features.edit', compact('pricingPlan', 'feature', 'languages'));
    }

    public function update(Request $request, PricingPlan $pricingPlan, PricingPlanFeature $feature)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
        ]);

        // Update translatable fields
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $feature->setTranslation('title', $language->lang_code, $request->{"title_{$language->lang_code}"} ?? '');
        }
        
        $feature->status = $request->has('status');
        $feature->save();

        return redirect()->route('admin.pricing-plans.features.index', $pricingPlan)->with('success', 'Feature updated successfully.');
    }

    public function destroy(PricingPlan $pricingPlan, PricingPlanFeature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.pricing-plans.features.index', $pricingPlan)->with('success', 'Feature deleted successfully.');
    }

    public function updateOrder(Request $request, PricingPlan $pricingPlan)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'required|integer|exists:pricing_plan_features,id'
        ]);

        foreach ($request->orders as $index => $id) {
            PricingPlanFeature::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleStatus(PricingPlan $pricingPlan, PricingPlanFeature $feature)
    {
        $feature->status = !$feature->status;
        $feature->save();
        
        return response()->json([
            'success' => true,
            'status' => $feature->status
        ]);
    }
}
