<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SeoSite extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'seo_title',
        'seo_keywords',
        'seo_description',
        'page_header',
        'page_footer',
        'index',
        'follow'
    ];

    public $translatable = [
        'seo_title',
        'seo_keywords',
        'seo_description'
    ];

    protected $casts = [
        'index' => 'boolean',
        'follow' => 'boolean'
    ];

    /**
     * Get a SEO setting value by key
     *
     * @param string $key
     * @return mixed|null
     */
    public static function getByKey($key)
    {
        $seo = self::first();
        if (!$seo) {
            return null;
        }
        
        return $seo->$key ?? null;
    }
}
