<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::with('category')->where('status', true);
        
        // Category filter
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }
        
        $portfolios = $query->orderBy('order')->paginate(12);
        $categories = PortfolioCategory::orderBy('order')->get();
        $selectedCategory = $request->category ?? 'all';
        
        return view('front.portfolios.index', compact('portfolios', 'categories', 'selectedCategory'));
    }
} 