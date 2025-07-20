<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate slug from title with support for multiple languages including Russian
     */
    public static function generateSlug($title, $lang = 'az')
    {
        // Convert to lowercase
        $title = mb_strtolower($title, 'UTF-8');
        
        // Handle different languages
        switch ($lang) {
            case 'ru':
                $title = self::convertRussianToLatin($title);
                break;
            case 'az':
                $title = self::convertAzerbaijaniToLatin($title);
                break;
            case 'en':
                $title = self::convertEnglishToLatin($title);
                break;
            default:
                $title = self::convertToLatin($title);
                break;
        }
        
        // Generate base slug
        $baseSlug = Str::slug($title);
        
        return $baseSlug;
    }
    
    /**
     * Convert Russian (Cyrillic) characters to Latin
     */
    private static function convertRussianToLatin($text)
    {
        $cyrillic = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        
        $latin = [
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya',
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya'
        ];
        
        return str_replace($cyrillic, $latin, $text);
    }
    
    /**
     * Convert Azerbaijani characters to Latin
     */
    private static function convertAzerbaijaniToLatin($text)
    {
        $azerbaijani = [
            'ə', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç',
            'Ə', 'Ğ', 'Ü', 'Ş', 'I', 'Ö', 'Ç'
        ];
        
        $latin = [
            'e', 'gh', 'u', 'sh', 'i', 'o', 'ch',
            'e', 'gh', 'u', 'sh', 'i', 'o', 'ch'
        ];
        
        return str_replace($azerbaijani, $latin, $text);
    }
    
    /**
     * Convert English characters (already Latin, just clean)
     */
    private static function convertEnglishToLatin($text)
    {
        // English is already Latin, just return as is
        return $text;
    }
    
    /**
     * General conversion to Latin
     */
    private static function convertToLatin($text)
    {
        // First try Azerbaijani
        $text = self::convertAzerbaijaniToLatin($text);
        
        // Then try Russian
        $text = self::convertRussianToLatin($text);
        
        return $text;
    }
    
    /**
     * Generate unique slug for model
     */
    public static function generateUniqueSlug($title, $model, $lang = 'az', $excludeId = null)
    {
        $baseSlug = self::generateSlug($title, $lang);
        $slug = $baseSlug;
        $counter = 1;
        
        $query = $model::where('slug->' . $lang, $slug);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        while ($query->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
            
            $query = $model::where('slug->' . $lang, $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }
        
        return $slug;
    }
    
    /**
     * Get JavaScript code for slug generation
     */
    public static function getJavaScriptCode()
    {
        return "
        function generateSlug(text, lang = 'az') {
            // Convert to lowercase
            text = text.toLowerCase();
            
            // Handle different languages
            switch (lang) {
                case 'ru':
                    return convertRussianToLatin(text);
                case 'az':
                    return convertAzerbaijaniToLatin(text);
                case 'en':
                    return convertEnglishToLatin(text);
                default:
                    return convertToLatin(text);
            }
        }
        
        function convertRussianToLatin(text) {
            const cyrillicMap = {
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'sch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
                'А': 'a', 'Б': 'b', 'В': 'v', 'Г': 'g', 'Д': 'd', 'Е': 'e', 'Ё': 'yo', 'Ж': 'zh', 'З': 'z', 'И': 'i', 'Й': 'y', 'К': 'k', 'Л': 'l', 'М': 'm', 'Н': 'n', 'О': 'o', 'П': 'p', 'Р': 'r', 'С': 's', 'Т': 't', 'У': 'u', 'Ф': 'f', 'Х': 'h', 'Ц': 'ts', 'Ч': 'ch', 'Ш': 'sh', 'Щ': 'sch', 'Ъ': '', 'Ы': 'y', 'Ь': '', 'Э': 'e', 'Ю': 'yu', 'Я': 'ya'
            };
            
            return text.replace(/[а-яёА-ЯЁ]/g, function(match) {
                return cyrillicMap[match] || match;
            });
        }
        
        function convertAzerbaijaniToLatin(text) {
            const azerbaijaniMap = {
                'ə': 'e', 'ğ': 'gh', 'ü': 'u', 'ş': 'sh', 'ı': 'i', 'ö': 'o', 'ç': 'ch',
                'Ə': 'e', 'Ğ': 'gh', 'Ü': 'u', 'Ş': 'sh', 'I': 'i', 'Ö': 'o', 'Ç': 'ch'
            };
            
            return text.replace(/[əğüşıöçƏĞÜŞIÖÇ]/g, function(match) {
                return azerbaijaniMap[match] || match;
            });
        }
        
        function convertEnglishToLatin(text) {
            return text;
        }
        
        function convertToLatin(text) {
            text = convertAzerbaijaniToLatin(text);
            text = convertRussianToLatin(text);
            return text;
        }
        
        function generateSlugFinal(text, lang = 'az') {
            let slug = generateSlug(text, lang);
            
            // Remove special characters except spaces and hyphens
            slug = slug.replace(/[^\\w\\s-]/g, '');
            
            // Replace spaces with hyphens
            slug = slug.replace(/\\s+/g, '-');
            
            // Replace multiple hyphens with single hyphen
            slug = slug.replace(/-+/g, '-');
            
            // Remove leading/trailing hyphens
            slug = slug.replace(/^-+|-+$/g, '');
            
            return slug;
        }
        ";
    }
} 