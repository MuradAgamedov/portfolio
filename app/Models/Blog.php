<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'card_image_alt_text',
        'main_description',
        'inner_description',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'card_image',
        'main_image',
        'status',
        'published_at',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'card_image_alt_text' => 'array',
        'main_description' => 'array',
        'inner_description' => 'array',
        'seo_title' => 'array',
        'seo_keywords' => 'array',
        'seo_description' => 'array',
        'status' => 'boolean',
        'published_at' => 'datetime',
        'order' => 'integer'
    ];

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
     * Get card image alt text for specific language
     */
    public function getCardImageAltText($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->card_image_alt_text[$lang] ?? $this->card_image_alt_text['az'] ?? '';
    }

    /**
     * Get main description for specific language
     */
    public function getMainDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->main_description[$lang] ?? $this->main_description['az'] ?? '';
    }

    /**
     * Get inner description for specific language
     */
    public function getInnerDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->inner_description[$lang] ?? $this->inner_description['az'] ?? '';
    }

    /**
     * Get SEO title for specific language
     */
    public function getSeoTitle($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->seo_title[$lang] ?? $this->seo_title['az'] ?? '';
    }

    /**
     * Get SEO keywords for specific language
     */
    public function getSeoKeywords($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->seo_keywords[$lang] ?? $this->seo_keywords['az'] ?? '';
    }

    /**
     * Get SEO description for specific language
     */
    public function getSeoDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->seo_description[$lang] ?? $this->seo_description['az'] ?? '';
    }

    /**
     * Get card image URL
     */
    public function getCardImageUrl()
    {
        if ($this->card_image) {
            return \Storage::disk('public')->url($this->card_image);
        }
        return null;
    }

    /**
     * Get main image URL
     */
    public function getMainImageUrl()
    {
        if ($this->main_image) {
            return \Storage::disk('public')->url($this->main_image);
        }
        return null;
    }

    /**
     * Generate slug from title
     */
    public function generateSlug($title, $lang = 'az')
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug->' . $lang, $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedDate()
    {
        return $this->published_at ? $this->published_at->format('d.m.Y H:i') : '';
    }

    /**
     * Scope for active blogs
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for published blogs
     */
    public function scopePublished($query)
    {
        return $query->where('status', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }
}
