<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Social;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs with pagination
     */
    public function index(Request $request)
    {
        $query = Blog::where('status', true)->orderBy('published_at', 'desc');
        
        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug->' . app()->getLocale(), $request->category);
            });
        }
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(title, '$.az') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(title, '$.ru') LIKE ?", ["%{$search}%"]);
            });
        }
        
        $blogs = $query->paginate(9);
        $categories = BlogCategory::where('status', true)->orderBy('order')->get();
        
        return view('front.blogs.index', compact('blogs', 'categories'));
    }
    
    /**
     * Display the specified blog
     */
    public function show($slug)
    {
        $blog = Blog::where('status', true)
                   ->where("slug->" . app()->getLocale(), $slug)
                   ->firstOrFail();
        
        $recentBlogs = Blog::where('status', true)
                          ->where('id', '!=', $blog->id)
                          ->orderBy('published_at', 'desc')
                          ->limit(3)
                          ->get();
        
        return view('front.blogs.show', compact('blog', 'recentBlogs'));
    }
} 