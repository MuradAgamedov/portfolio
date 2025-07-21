<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'icon',
        'icon_alt_text',
        'order',
        'status'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'icon_alt_text' => 'array',
        'status' => 'boolean',
        'order' => 'integer'
    ];

    // Icon options
    public static function getIcons()
    {
        return [
            'fas fa-code' => 'Code',
            'fas fa-palette' => 'Design',
            'fas fa-mobile-alt' => 'Mobile',
            'fas fa-laptop-code' => 'Web Development',
            'fas fa-database' => 'Database',
            'fas fa-cloud' => 'Cloud',
            'fas fa-shield-alt' => 'Security',
            'fas fa-rocket' => 'Performance',
            'fas fa-users' => 'Team',
            'fas fa-cogs' => 'Settings',
            'fas fa-chart-line' => 'Analytics',
            'fas fa-bullhorn' => 'Marketing',
            'fas fa-shopping-cart' => 'E-commerce',
            'fas fa-gamepad' => 'Gaming',
            'fas fa-video' => 'Video',
            'fas fa-music' => 'Audio',
            'fas fa-camera' => 'Photography',
            'fas fa-pen-fancy' => 'Writing',
            'fas fa-graduation-cap' => 'Education',
            'fas fa-heartbeat' => 'Health'
        ];
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
     * Get description for specific language
     */
    public function getDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->description[$lang] ?? $this->description['az'] ?? '';
    }

    /**
     * Get icon alt text for specific language
     */
    public function getIconAltText($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->icon_alt_text[$lang] ?? $this->icon_alt_text['az'] ?? '';
    }

    /**
     * Get icon URL
     */
    public function getIconUrl()
    {
        if ($this->icon) {
            return \Storage::disk('public')->url($this->icon);
        }
        return null;
    }

    /**
     * Get slug for specific language
     */
    public function getSlug($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        $title = $this->getTitle($lang);
        return \Str::slug($title);
    }
} 