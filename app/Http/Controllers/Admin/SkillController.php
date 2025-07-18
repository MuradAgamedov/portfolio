<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Language;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of skills
     */
    public function index()
    {
        $skills = Skill::ordered()->get();
        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new skill
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.skills.create', compact('languages'));
    }

    /**
     * Store a newly created skill
     */
    public function store(Request $request)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'percent' => 'required|integer|min:0|max:100',
            'status' => 'boolean',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');
        $validated['order'] = Skill::max('order') + 1;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Bacarıq uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing the specified skill
     */
    public function edit(Skill $skill)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.skills.edit', compact('skill', 'languages'));
    }

    /**
     * Update the specified skill
     */
    public function update(Request $request, Skill $skill)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'percent' => 'required|integer|min:0|max:100',
            'status' => 'boolean',
        ];

        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        // Handle status separately
        $validated['status'] = $request->has('status');

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Bacarıq uğurla yeniləndi!');
    }

    /**
     * Remove the specified skill
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Bacarıq uğurla silindi!');
    }

    /**
     * Reorder skills
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:skills,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Skill::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
