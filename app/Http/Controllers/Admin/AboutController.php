<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Show the form for editing about
     */
    public function edit()
    {
        $about = About::first();
        if (!$about) {
            // Create default about record if doesn't exist
            $about = About::create([
                'description' => ['az' => '', 'en' => ''],
                'status' => true,
                'order' => 1
            ]);
        }
        
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.about.edit', compact('about', 'languages'));
    }

    /**
     * Update about
     */
    public function update(Request $request)
    {
        $about = About::first();
        if (!$about) {
            return redirect()->back()->with('error', 'Haqqımda məlumatı tapılmadı!');
        }

        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'status' => 'boolean',
        ];

        foreach ($languages as $language) {
            $rules["description.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle CV file upload
        if ($request->hasFile('cv_file')) {
            // Delete old CV file if exists
            if ($about->cv_file && Storage::disk('public')->exists($about->cv_file)) {
                Storage::disk('public')->delete($about->cv_file);
            }

            $cvFile = $request->file('cv_file');
            $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
            $cvPath = $cvFile->storeAs('cv', $cvFileName, 'public');
            
            $validated['cv_file'] = $cvPath;
            $validated['cv_original_name'] = $cvFile->getClientOriginalName();
        }

        // Handle status separately
        $validated['status'] = $request->has('status');

        $about->update($validated);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Haqqımda məlumatı uğurla yeniləndi!');
    }

    /**
     * Download CV file
     */
    public function downloadCv()
    {
        $about = About::first();
        if (!$about || !$about->cv_file || !Storage::disk('public')->exists($about->cv_file)) {
            return redirect()->back()->with('error', 'CV faylı tapılmadı!');
        }

        return Storage::disk('public')->download($about->cv_file, $about->cv_original_name);
    }
}
