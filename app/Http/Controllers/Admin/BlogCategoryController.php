<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::orderBy('order')->get();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        $languages = Language::where('status', true)->get();
        return view('admin.blog-categories.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = Language::where('status', true)->get();
        
        $rules = [];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["slug.{$language->lang_code}"] = 'nullable|string|max:255|unique:blog_categories,slug->' . $language->lang_code;
        }
        
        $validated = $request->validate($rules);
        
        // Handle status separately since checkbox might not be sent if unchecked
        $validated['status'] = $request->has('status');
        $validated['order'] = BlogCategory::max('order') + 1;
        
        // Use provided slugs or generate automatically
        $validated['slug'] = [];
        foreach ($languages as $language) {
            $slug = $request->input("slug.{$language->lang_code}");
            if (empty($slug)) {
                $title = $request->input("title.{$language->lang_code}");
                $validated['slug'][$language->lang_code] = (new BlogCategory())->generateSlug($title, $language->lang_code);
            } else {
                $validated['slug'][$language->lang_code] = $slug;
            }
        }
        
        BlogCategory::create($validated);
        
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog kateqoriyası uğurla əlavə edildi!');
    }

    public function edit(BlogCategory $blogCategory)
    {
        $languages = Language::where('status', true)->get();
        return view('admin.blog-categories.edit', compact('blogCategory', 'languages'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $languages = Language::where('status', true)->get();
        
        $rules = [];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["slug.{$language->lang_code}"] = 'nullable|string|max:255|unique:blog_categories,slug->' . $language->lang_code . ',' . $blogCategory->id;
        }
        
        $validated = $request->validate($rules);
        
        // Handle status separately since checkbox might not be sent if unchecked
        $validated['status'] = $request->has('status');
        
        // Use provided slugs or generate automatically
        $validated['slug'] = [];
        foreach ($languages as $language) {
            $slug = $request->input("slug.{$language->lang_code}");
            if (empty($slug)) {
                $title = $request->input("title.{$language->lang_code}");
                $validated['slug'][$language->lang_code] = $blogCategory->generateSlug($title, $language->lang_code);
            } else {
                $validated['slug'][$language->lang_code] = $slug;
            }
        }
        
        $blogCategory->update($validated);
        
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog kateqoriyası uğurla yeniləndi!');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog kateqoriyası uğurla silindi!');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items', []);
        
        foreach ($items as $index => $id) {
            BlogCategory::where('id', $id)->update(['order' => $index + 1]);
        }
        
        return response()->json(['success' => true]);
    }
} 