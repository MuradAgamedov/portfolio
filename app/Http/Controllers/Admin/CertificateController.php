<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Language;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates
     */
    public function index()
    {
        $certificates = Certificate::orderBy('order')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new certificate
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.certificates.create', compact('languages'));
    }

    /**
     * Store a newly created certificate
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt_text' => 'required|array',
            'image_alt_text.*' => 'required|string|max:255',
            'issue_date' => 'required|date',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('certificates/images', 'public');
        }

        $certificate = Certificate::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'image_alt_text' => $request->image_alt_text,
            'issue_date' => $request->issue_date,
            'status' => $request->has('status'),
            'order' => Certificate::max('order') + 1
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing a certificate
     */
    public function edit(Certificate $certificate)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.certificates.edit', compact('certificate', 'languages'));
    }

    /**
     * Update the specified certificate
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt_text' => 'required|array',
            'image_alt_text.*' => 'required|string|max:255',
            'issue_date' => 'required|date',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'image_alt_text' => $request->image_alt_text,
            'issue_date' => $request->issue_date,
            'status' => $request->has('status')
        ];

        // Upload new image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($certificate->image && \Storage::disk('public')->exists($certificate->image)) {
                \Storage::disk('public')->delete($certificate->image);
            }
            
            // Upload new image
            $imagePath = $request->file('image')->store('certificates/images', 'public');
            $updateData['image'] = $imagePath;
        }

        $certificate->update($updateData);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat uğurla yeniləndi!');
    }

    /**
     * Remove the specified certificate
     */
    public function destroy(Certificate $certificate)
    {
        // Delete image file
        if ($certificate->image && \Storage::disk('public')->exists($certificate->image)) {
            \Storage::disk('public')->delete($certificate->image);
        }
        
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat uğurla silindi!');
    }

    /**
     * Reorder certificates
     */
    public function reorder(Request $request)
    {
        \Log::info('Reorder request received', [
            'orders' => $request->orders,
            'all_data' => $request->all()
        ]);

        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:certificates,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Certificate::where('id', $item['id'])->update(['order' => $item['order']]);
            \Log::info("Updated certificate {$item['id']} to order {$item['order']}");
        }

        \Log::info('Reorder completed successfully');
        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
}
