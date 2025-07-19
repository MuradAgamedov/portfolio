<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Language;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display the site settings form
     */
    public function index()
    {
        $settings = SiteSetting::first();
        $languages = Language::orderBy('order')->get();
        
        if (!$settings) {
            $settings = SiteSetting::create();
        }
        
        return view('admin.site-settings.index', compact('settings', 'languages'));
    }

    /**
     * Update site settings
     */
    public function update(Request $request)
    {
        $settings = SiteSetting::first();
        
        if (!$settings) {
            $settings = SiteSetting::create();
        }

        // Handle file uploads
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $settings->favicon = $this->imageService->uploadImage($file, 'site-settings');
        }
        
        if ($request->hasFile('header_logo')) {
            $file = $request->file('header_logo');
            $settings->header_logo = $this->imageService->uploadImage($file, 'site-settings');
        }
        
        if ($request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $settings->footer_logo = $this->imageService->uploadImage($file, 'site-settings');
        }
        
        if ($request->hasFile('contact_section_image')) {
            $file = $request->file('contact_section_image');
            $settings->contact_section_image = $this->imageService->uploadImage($file, 'site-settings');
        }

        // Update translatable fields for all languages
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $settings->setTranslation('title', $language->lang_code, $request->{"title_{$language->lang_code}"} ?? '');
            $settings->setTranslation('header_logo_alt', $language->lang_code, $request->{"header_logo_alt_{$language->lang_code}"} ?? '');
            $settings->setTranslation('footer_logo_alt', $language->lang_code, $request->{"footer_logo_alt_{$language->lang_code}"} ?? '');
            $settings->setTranslation('contact_section_alt', $language->lang_code, $request->{"contact_section_alt_{$language->lang_code}"} ?? '');
        }
        
        // Update contact section content for all languages
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $settings->setTranslation('contact_section_text', $language->lang_code, $request->{"contact_section_text_{$language->lang_code}"} ?? '');
        }

        // Update non-translatable fields
        $settings->phone = $request->phone;
        $settings->email = $request->email;

        $settings->save();

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Site settings updated successfully.');
    }
}
