<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickContact;
use Illuminate\Http\Request;

class QuickContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quickContacts = QuickContact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.quick-contacts.index', compact('quickContacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quickContact = QuickContact::findOrFail($id);
        
        // Mark as read
        if (!$quickContact->is_read) {
            $quickContact->update(['is_read' => true]);
        }
        
        return view('admin.quick-contacts.show', compact('quickContact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy(string $id)
    {
        $quickContact = QuickContact::findOrFail($id);
        $quickContact->delete();
        
        return redirect()->route('admin.quick-contacts.index')
            ->with('success', 'Sürətli əlaqə mesajı silindi.');
    }

    /**
     * Mark as read/unread
     */
    public function toggleRead(string $id)
    {
        $quickContact = QuickContact::findOrFail($id);
        $quickContact->update(['is_read' => !$quickContact->is_read]);
        
        return redirect()->back()->with('success', 'Status yeniləndi.');
    }
}
