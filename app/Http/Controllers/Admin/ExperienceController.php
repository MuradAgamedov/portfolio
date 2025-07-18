<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Language;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of experience
     */
    public function index()
    {
        $experiences = Experience::ordered()->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new experience
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.experiences.create', compact('languages'));
    }

    /**
     * Store a newly created experience
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
            $rules["company_name.{$language->lang_code}"] = 'required|string|max:255';
            $rules["description.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');
        $validated['order'] = Experience::max('order') + 1;

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Təcrübə uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing the specified experience
     */
    public function edit(Experience $experience)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.experiences.edit', compact('experience', 'languages'));
    }

    /**
     * Update the specified experience
     */
    public function update(Request $request, Experience $experience)
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
            $rules["company_name.{$language->lang_code}"] = 'required|string|max:255';
            $rules["description.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Təcrübə uğurla yeniləndi!');
    }

    /**
     * Remove the specified experience
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Təcrübə uğurla silindi!');
    }

    /**
     * Reorder experience
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:experiences,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Experience::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
