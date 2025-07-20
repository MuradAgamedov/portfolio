<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\SlugService;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    /**
     * Get title for specific language
     */
    public function getTitle($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->title[$lang] ?? $this->title['az'] ?? '';
    }

    /**
     * Get slug for specific language
     */
    public function getSlug($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->slug[$lang] ?? $this->slug['az'] ?? '';
    }

    /**
     * Generate slug from title
     */
    public function generateSlug($title, $lang = 'az')
    {
        return SlugService::generateUniqueSlug($title, static::class, $lang, $this->id);
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get translation for specific field and language
     */
    public function getTranslation($field, $lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->$field[$lang] ?? $this->$field['az'] ?? '';
    }
} 