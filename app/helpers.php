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