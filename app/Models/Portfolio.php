<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'company_name',
        'company_website',
        'project_link',
        'category_id',
        'order',
        'status'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
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
     * Get image URL
     */
    public function getImageUrl()
    {
        if ($this->image) {
            return \Storage::disk('public')->url($this->image);
        }
        return null;
    }
}
