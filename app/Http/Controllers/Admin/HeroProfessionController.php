<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroProfession;
use App\Models\Language;

class HeroProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professions = HeroProfession::orderBy('order')->get();
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.hero-professions.index', compact('professions', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.hero-professions.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        $rules = ['title' => 'required|array'];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'status' => (bool) $request->status,
            'order' => HeroProfession::max('order') + 1
        ];

        HeroProfession::create($data);

        return redirect()->route('admin.hero-professions.index')->with('success', 'Peşə uğurla əlavə edildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profession = HeroProfession::findOrFail($id);
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.hero-professions.edit', compact('profession', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profession = HeroProfession::findOrFail($id);
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        $rules = ['title' => 'required|array'];
        foreach ($languages as $language) {
            $rules["title.{$language->lang_code}"] = 'required|string|max:255';
        }

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'status' => (bool) $request->status
        ];

        $profession->update($data);

        return redirect()->route('admin.hero-professions.index')->with('success', 'Peşə uğurla yeniləndi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profession = HeroProfession::findOrFail($id);
        $profession->delete();

        return redirect()->route('admin.hero-professions.index')->with('success', 'Peşə uğurla silindi!');
    }

    /**
     * Reorder professions
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:hero_professions,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            HeroProfession::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
}
