<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from URL parameter
        $locale = $request->route('locale');
        
        if ($locale) {
            // Check if locale is valid
            $availableLanguages = \App\Models\Language::where('status', 1)->pluck('lang_code')->toArray();
            
            if (in_array($locale, $availableLanguages)) {
                app()->setLocale($locale);
                session(['locale' => $locale]);
            } else {
                // Redirect to default language if invalid
                $defaultLanguage = \App\Models\Language::where('is_main_lang', 1)->first();
                $defaultLang = $defaultLanguage ? $defaultLanguage->lang_code : 'en';
                return redirect('/' . $defaultLang);
            }
        } else {
            // Set locale from session if exists
            if (session()->has('locale')) {
                app()->setLocale(session('locale'));
            } else {
                // Set default locale from config
                app()->setLocale(config('app.locale'));
            }
        }

        return $next($request);
    }
} 