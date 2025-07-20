<?php

use App\Models\Dictionary;

if (!function_exists('dict')) {
    /**
     * Get translation from dictionary
     */
    function dict($keyword, $lang = null)
    {
        return Dictionary::translate($keyword, $lang);
    }
}

if (!function_exists('dict_has')) {
    /**
     * Check if keyword exists in dictionary
     */
    function dict_has($keyword)
    {
        return Dictionary::hasKeyword($keyword);
    }
}

if (!function_exists('get_available_languages')) {
    /**
     * Get available languages for language switcher
     */
    function get_available_languages()
    {
        return \App\Models\Language::where('status', 1)->orderBy('order')->get();
    }
}

if (!function_exists('get_current_language')) {
    /**
     * Get current language info
     */
    function get_current_language()
    {
        $currentLocale = app()->getLocale();
        return \App\Models\Language::where('lang_code', $currentLocale)->first();
    }
}

if (!function_exists('localized_route')) {
    /**
     * Generate localized route URL
     */
    function localized_route($name, $parameters = [], $absolute = true)
    {
        $locale = app()->getLocale();
        
        // Add locale to parameters
        $parameters['locale'] = $locale;
        
        return route($name, $parameters, $absolute);
    }
}

if (!function_exists('switch_language_url')) {
    /**
     * Generate URL for switching to specific language
     */
    function switch_language_url($locale, $currentUrl = null)
    {
        // Get current route name and parameters
        $routeName = request()->route()->getName();
        $routeParameters = request()->route()->parameters();
        
        // Remove locale from parameters and add new locale
        unset($routeParameters['locale']);
        $routeParameters['locale'] = $locale;
        
        // Generate new URL with different locale
        return route($routeName, $routeParameters, true);
    }
} 