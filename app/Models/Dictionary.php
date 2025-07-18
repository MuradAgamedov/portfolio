<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'values'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    /**
     * Get value for specific language
     */
    public function getValue($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->values[$lang] ?? $this->values['az'] ?? $this->keyword;
    }

    /**
     * Get all values as array
     */
    public function getAllValues()
    {
        return $this->values ?? [];
    }

    /**
     * Check if keyword exists
     */
    public static function hasKeyword($keyword)
    {
        return static::where('keyword', $keyword)->exists();
    }

    /**
     * Get translation by keyword
     */
    public static function translate($keyword, $lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        $dictionary = static::where('keyword', $keyword)->first();
        
        if ($dictionary) {
            return $dictionary->getValue($lang);
        }
        
        return $keyword; // Return keyword if translation not found
    }
}
