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
        $url = route($name, $parameters, $absolute);
        
        // If URL doesn't already have locale, add it
        if (!preg_match('/^https?:\/\/[^\/]+\/[a-z]{2}\//', $url)) {
            $url = str_replace(request()->getSchemeAndHttpHost(), request()->getSchemeAndHttpHost() . '/' . $locale, $url);
        }
        
        return $url;
    }
}

if (!function_exists('switch_language_url')) {
    /**
     * Generate URL for switching to specific language
     */
    function switch_language_url($locale, $currentUrl = null)
    {
        if (!$currentUrl) {
            $currentUrl = request()->fullUrl();
        }
        
        // Get current route name and parameters
        $routeName = request()->route()->getName();
        $routeParameters = request()->route()->parameters();
        
        // Remove locale from parameters
        unset($routeParameters['locale']);
        
        // Generate new URL with different locale
        $url = route($routeName, $routeParameters, true);
        $url = str_replace(request()->getSchemeAndHttpHost(), request()->getSchemeAndHttpHost() . '/' . $locale, $url);
        
        return $url;
    }
} 