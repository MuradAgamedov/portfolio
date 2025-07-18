<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSite;
use App\Models\Language;
use Illuminate\Http\Request;

class SeoSiteController extends Controller
{
    /**
     * Display the SEO settings form
     */
    public function index()
    {
        $seo = SeoSite::first();
        $languages = Language::orderBy('order')->get();
        
        if (!$seo) {
            $seo = SeoSite::create([
                'index' => true,
                'follow' => true
            ]);
        }
        
        return view('admin.seo-site.index', compact('seo', 'languages'));
    }

    /**
     * Update SEO settings
     */
    public function update(Request $request)
    {
        $seo = SeoSite::first();
        
        if (!$seo) {
            $seo = SeoSite::create();
        }

        // Update translatable fields
        $languages = Language::orderBy('order')->get();
        foreach ($languages as $language) {
            $seo->setTranslation('seo_title', $language->lang_code, $request->{"seo_title_{$language->lang_code}"} ?? '');
            $seo->setTranslation('seo_keywords', $language->lang_code, $request->{"seo_keywords_{$language->lang_code}"} ?? '');
            $seo->setTranslation('seo_description', $language->lang_code, $request->{"seo_description_{$language->lang_code}"} ?? '');
        }

        // Update non-translatable fields
        $seo->page_header = $request->page_header;
        $seo->page_footer = $request->page_footer;
        $seo->index = $request->has('index');
        $seo->follow = $request->has('follow');

        $seo->save();

        return redirect()->route('admin.seo-site.index')
            ->with('success', 'SEO settings updated successfully.');
    }
}
