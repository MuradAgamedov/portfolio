<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'favicon',
        'header_logo',
        'header_logo_alt',
        'footer_logo',
        'footer_logo_alt',
        'phone',
        'email',
        'contact_section_image',
        'contact_section_alt',
        'contact_section_title',
        'contact_section_text'
    ];

    public $translatable = [
        'title',
        'header_logo_alt',
        'footer_logo_alt',
        'contact_section_alt',
        'contact_section_title',
        'contact_section_text'
    ];

    /**
     * Get a site setting value by key
     *
     * @param string $key
     * @return mixed|null
     */
    public static function getByKey($key)
    {
        $setting = self::first();
        if (!$setting) {
            return null;
        }
        
        return $setting->$key ?? null;
    }
}
