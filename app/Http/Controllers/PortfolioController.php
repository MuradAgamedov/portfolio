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
        
        // Category filter by slug
        if ($request->has('category') && $request->category != 'all') {
            $category = PortfolioCategory::where('status', true)->get()->first(function($cat) use ($request) {
                return $cat->getSlug() === $request->category;
            });
            
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        $portfolios = $query->orderBy('order')->paginate(12);
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        $selectedCategory = $request->category ?? 'all';
        
        return view('front.portfolios.index', compact('portfolios', 'categories', 'selectedCategory'));
    }
} 