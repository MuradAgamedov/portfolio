<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $blogs = Blog::orderBy('order')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = BlogCategory::where('status', true)->orderBy('order')->get();
        return view('admin.blogs.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'category_id' => 'nullable|exists:blog_categories,id',
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["card_image_alt_text.{$language->lang_code}"] = 'required|string|max:255';
            $rules["main_image_alt_text.{$language->lang_code}"] = 'required|string|max:255';
            $rules["main_description.{$language->lang_code}"] = 'required|string';
            $rules["seo_title.{$language->lang_code}"] = 'nullable|string|max:255';
            $rules["seo_keywords.{$language->lang_code}"] = 'nullable|string';
            $rules["seo_description.{$language->lang_code}"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');
        $validated['order'] = Blog::max('order') + 1;

        // Generate slugs automatically
        $validated['slug'] = [];
        foreach ($languages as $language) {
            $title = $request->input("title.{$language->lang_code}");
            $validated['slug'][$language->lang_code] = (new Blog())->generateSlug($title, $language->lang_code);
        }

        // Handle image uploads
        if ($request->hasFile('card_image')) {
            $validated['card_image'] = $this->imageService->uploadImage($request->file('card_image'), 'blogs/card');
        }

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $this->imageService->uploadImage($request->file('main_image'), 'blogs/main');
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing a blog
     */
    public function edit(Blog $blog)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = BlogCategory::where('status', true)->orderBy('order')->get();
        return view('admin.blogs.edit', compact('blog', 'languages', 'categories'));
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, Blog $blog)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'category_id' => 'nullable|exists:blog_categories,id',
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["card_image_alt_text.{$language->lang_code}"] = 'required|string|max:255';
            $rules["main_image_alt_text.{$language->lang_code}"] = 'required|string|max:255';
            $rules["main_description.{$language->lang_code}"] = 'required|string';
            $rules["seo_title.{$language->lang_code}"] = 'nullable|string|max:255';
            $rules["seo_keywords.{$language->lang_code}"] = 'nullable|string';
            $rules["seo_description.{$language->lang_code}"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');

        // Handle slugs - only update if manually edited
        $validated['slug'] = $blog->slug;
        foreach ($languages as $language) {
            $slugKey = "slug.{$language->lang_code}";
            if ($request->has($slugKey) && $request->input($slugKey)) {
                $validated['slug'][$language->lang_code] = $request->input($slugKey);
            } else {
                // Auto-generate slug if not provided
                $title = $request->input("title.{$language->lang_code}");
                $validated['slug'][$language->lang_code] = $blog->generateSlug($title, $language->lang_code);
            }
        }

        // Handle image uploads
        if ($request->hasFile('card_image')) {
            $validated['card_image'] = $this->imageService->updateImage(
                $request->file('card_image'),
                $blog->card_image,
                'blogs/card'
            );
        }

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $this->imageService->updateImage(
                $request->file('main_image'),
                $blog->main_image,
                'blogs/main'
            );
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog uğurla yeniləndi!');
    }

    /**
     * Remove the specified blog
     */
    public function destroy(Blog $blog)
    {
        // Delete images
        if ($blog->card_image) {
            Storage::disk('public')->delete($blog->card_image);
        }
        if ($blog->main_image) {
            Storage::disk('public')->delete($blog->main_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog uğurla silindi!');
    }

    /**
     * Reorder blogs
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:blogs,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Blog::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
}
