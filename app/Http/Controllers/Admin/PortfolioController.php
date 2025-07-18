<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Language;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios
     */
    public function index(Request $request)
    {
        $query = Portfolio::with('category')->orderBy('order');
        
        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $portfolios = $query->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        
        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    /**
     * Show the form for creating a new portfolio
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        return view('admin.portfolios.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created portfolio
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'project_link' => 'nullable|url|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios/images', 'public');
        }

        $portfolio = Portfolio::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'project_link' => $request->project_link,
            'category_id' => $request->category_id,
            'status' => $request->has('status'),
            'order' => Portfolio::max('order') + 1
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing a portfolio
     */
    public function edit(Portfolio $portfolio)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        return view('admin.portfolios.edit', compact('portfolio', 'languages', 'categories'));
    }

    /**
     * Update the specified portfolio
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'project_link' => 'nullable|url|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'project_link' => $request->project_link,
            'category_id' => $request->category_id,
            'status' => $request->has('status')
        ];

        // Upload new image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image && \Storage::disk('public')->exists($portfolio->image)) {
                \Storage::disk('public')->delete($portfolio->image);
            }
            
            // Upload new image
            $imagePath = $request->file('image')->store('portfolios/images', 'public');
            $updateData['image'] = $imagePath;
        }

        $portfolio->update($updateData);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla yeniləndi!');
    }

    /**
     * Remove the specified portfolio
     */
    public function destroy(Portfolio $portfolio)
    {
        // Delete image file
        if ($portfolio->image && \Storage::disk('public')->exists($portfolio->image)) {
            \Storage::disk('public')->delete($portfolio->image);
        }
        
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla silindi!');
    }

    /**
     * Reorder portfolios
     */
    public function reorder(Request $request)
    {
        \Log::info('Reorder request received', [
            'orders' => $request->orders,
            'all_data' => $request->all()
        ]);

        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:portfolios,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Portfolio::where('id', $item['id'])->update(['order' => $item['order']]);
            \Log::info("Updated portfolio {$item['id']} to order {$item['order']}");
        }

        \Log::info('Reorder completed successfully');
        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
}
