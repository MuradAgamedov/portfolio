<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::orderBy('order')->get();
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        $languages = Language::where('status', true)->get();
        return view('admin.portfolio-categories.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = Language::where('status', true)->get();
        
        $rules = [];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }
        
        $validated = $request->validate($rules);
        
        // Handle status separately since checkbox might not be sent if unchecked
        $validated['status'] = $request->has('status');
        $validated['order'] = PortfolioCategory::max('order') + 1;
        
        PortfolioCategory::create($validated);
        
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category created successfully.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        $languages = Language::where('status', true)->get();
        return view('admin.portfolio-categories.edit', compact('portfolioCategory', 'languages'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $languages = Language::where('status', true)->get();
        
        $rules = [];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }
        
        $validated = $request->validate($rules);
        
        // Handle status separately since checkbox might not be sent if unchecked
        $validated['status'] = $request->has('status');
        
        // Debug logging
        \Log::info('Portfolio Category Update', [
            'category_id' => $portfolioCategory->id,
            'request_has_status' => $request->has('status'),
            'request_status_value' => $request->input('status'),
            'validated_status' => $validated['status'],
            'old_status' => $portfolioCategory->status,
            'all_request_data' => $request->all()
        ]);
        
        $portfolioCategory->update($validated);
        
        // Log after update
        \Log::info('Portfolio Category Updated', [
            'category_id' => $portfolioCategory->id,
            'new_status' => $portfolioCategory->fresh()->status
        ]);
        
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category updated successfully.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->delete();
        
        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Portfolio category deleted successfully.');
    }

    public function reorder(Request $request)
    {
        \Log::info('Reorder request received', [
            'orders' => $request->orders,
            'all_data' => $request->all()
        ]);

        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:portfolio_categories,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            PortfolioCategory::where('id', $item['id'])->update(['order' => $item['order']]);
            \Log::info("Updated category {$item['id']} to order {$item['order']}");
        }

        \Log::info('Reorder completed successfully');
        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
}
