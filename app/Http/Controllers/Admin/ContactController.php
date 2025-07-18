<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($validated);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        // Mark as read when viewing
        if ($contact->isUnread()) {
            $contact->markAsRead();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'status' => 'required|in:unread,read,replied',
            'admin_reply' => 'nullable|string|max:1000',
        ]);

        if (isset($validated['admin_reply']) && !empty($validated['admin_reply'])) {
            $contact->markAsReplied($validated['admin_reply']);
        } else {
            $contact->update($validated);
        }

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead();

        return redirect()->back()
            ->with('success', 'Message marked as read.');
    }

    /**
     * Mark message as replied
     */
    public function markAsReplied(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string|max:1000',
        ]);

        $contact->markAsReplied($validated['admin_reply']);

        return redirect()->back()
            ->with('success', 'Reply sent successfully.');
    }

    /**
     * Show unread messages
     */
    public function unread()
    {
        $contacts = Contact::unread()->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Show read messages
     */
    public function read()
    {
        $contacts = Contact::read()->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Show replied messages
     */
    public function replied()
    {
        $contacts = Contact::replied()->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }
}
