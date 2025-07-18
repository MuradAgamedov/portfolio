<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Language;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of education
     */
    public function index()
    {
        $education = Education::ordered()->get();
        return view('admin.education.index', compact('education'));
    }

    /**
     * Show the form for creating a new education
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.education.create', compact('languages'));
    }

    /**
     * Store a newly created education
     */
    public function store(Request $request)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'boolean',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["university_name.{$language->lang_code}"] = 'required|string|max:255';
            $rules["description.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');
        $validated['order'] = Education::max('order') + 1;

        Education::create($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Təhsil uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing the specified education
     */
    public function edit(Education $education)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.education.edit', compact('education', 'languages'));
    }

    /**
     * Update the specified education
     */
    public function update(Request $request, Education $education)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'boolean',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
            $rules["university_name.{$language->lang_code}"] = 'required|string|max:255';
            $rules["description.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');

        $education->update($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Təhsil uğurla yeniləndi!');
    }

    /**
     * Remove the specified education
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Təhsil uğurla silindi!');
    }

    /**
     * Reorder education
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:education,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Education::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
