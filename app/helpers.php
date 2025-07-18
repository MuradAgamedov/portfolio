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