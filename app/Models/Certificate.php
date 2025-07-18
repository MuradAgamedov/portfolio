<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_alt_text',
        'issue_date',
        'order',
        'status'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'image_alt_text' => 'array',
        'issue_date' => 'date',
        'status' => 'boolean',
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
     * Get description for specific language
     */
    public function getDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->description[$lang] ?? $this->description['az'] ?? '';
    }

    /**
     * Get image alt text for specific language
     */
    public function getImageAltText($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->image_alt_text[$lang] ?? $this->image_alt_text['az'] ?? '';
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

    /**
     * Get formatted issue date
     */
    public function getFormattedIssueDate()
    {
        return $this->issue_date ? $this->issue_date->format('d.m.Y') : '';
    }
}
