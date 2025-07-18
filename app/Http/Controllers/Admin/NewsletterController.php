<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderBy('subscribed_at', 'desc')->paginate(20);
        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Newsletter subscription deleted successfully!'
        ]);
    }

    public function toggleStatus($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->status = !$newsletter->status;
        $newsletter->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'status' => $newsletter->status
        ]);
    }
} 