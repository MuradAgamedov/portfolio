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
        
        // Ensure parameters is an array
        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }
        
        // Add locale to parameters
        $parameters['locale'] = $locale;
        
        try {
            return route($name, $parameters, $absolute);
        } catch (\Exception $e) {
            // Fallback: generate URL manually
            $baseUrl = request()->getSchemeAndHttpHost();
            $path = '/' . $locale;
            
            // Add specific paths based on route name
            switch ($name) {
                case 'home':
                    return $baseUrl . $path;
                case 'blogs.index':
                    return $baseUrl . $path . '/blogs';
                case 'blog.show':
                    $blog = is_array($parameters) ? ($parameters[0] ?? null) : $parameters;
                    if ($blog instanceof \App\Models\Blog) {
                        return $baseUrl . $path . '/blog/' . $blog->id . '/' . $blog->getSlug();
                    } elseif (is_numeric($blog)) {
                        // If only ID is provided, get the blog and its slug
                        $blogModel = \App\Models\Blog::find($blog);
                        if ($blogModel) {
                            return $baseUrl . $path . '/blog/' . $blogModel->id . '/' . $blogModel->getSlug();
                        }
                    } elseif (is_string($blog)) {
                        // If slug is provided, find blog by slug and return with ID
                        $blogModel = \App\Models\Blog::where('status', true)
                            ->where("slug->" . app()->getLocale(), $blog)
                            ->first();
                        if ($blogModel) {
                            return $baseUrl . $path . '/blog/' . $blogModel->id . '/' . $blogModel->getSlug();
                        }
                    } elseif (is_array($parameters) && count($parameters) >= 2) {
                        // If both ID and slug are provided as array [id, slug]
                        $id = $parameters[0];
                        $slug = $parameters[1];
                        return $baseUrl . $path . '/blog/' . $id . '/' . $slug;
                    }
                    return $baseUrl . $path . '/blog/' . $blog;
                case 'services.index':
                    return $baseUrl . $path . '/services';
                case 'portfolios.index':
                    return $baseUrl . $path . '/portfolios';
                case 'about':
                    return $baseUrl . $path . '/about';
                case 'contact':
                    return $baseUrl . $path . '/contact';
                default:
                    return $baseUrl . $path;
            }
        }
    }
}

if (!function_exists('switch_language_url')) {
    /**
     * Generate URL for switching to specific language
     */
    function switch_language_url($locale, $currentUrl = null)
    {
        try {
            // Get current route name and parameters
            $routeName = request()->route()->getName();
            $routeParameters = request()->route()->parameters();
            
            // Ensure parameters is an array
            if (!is_array($routeParameters)) {
                $routeParameters = [];
            }
            
            // Remove locale from parameters and add new locale
            unset($routeParameters['locale']);
            $routeParameters['locale'] = $locale;
            
            // Generate new URL with different locale
            return route($routeName, $routeParameters, true);
        } catch (\Exception $e) {
            // Fallback: generate URL manually
            $baseUrl = request()->getSchemeAndHttpHost();
            $currentPath = request()->path();
            
            // Remove current locale from path if exists
            $pathParts = explode('/', $currentPath);
            if (count($pathParts) > 0 && in_array($pathParts[0], ['en', 'az', 'ru'])) {
                array_shift($pathParts);
            }
            
            $path = '/' . $locale . '/' . implode('/', $pathParts);
            return $baseUrl . $path;
        }
    }
} 