<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'university_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'university_name' => 'array',
        'description' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
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
     * Get university name for specific language
     */
    public function getUniversityName($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->university_name[$lang] ?? $this->university_name['az'] ?? '';
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
     * Get formatted start date
     */
    public function getFormattedStartDate()
    {
        return $this->start_date ? $this->start_date->format('d.m.Y') : '';
    }

    /**
     * Get formatted end date
     */
    public function getFormattedEndDate()
    {
        return $this->end_date ? $this->end_date->format('d.m.Y') : '';
    }

    /**
     * Check if education is ongoing
     */
    public function isOngoing()
    {
        return is_null($this->end_date);
    }

    /**
     * Get education duration
     */
    public function getDuration()
    {
        if ($this->isOngoing()) {
            return $this->start_date->format('Y') . ' - ' . 'Davam edir';
        }
        
        return $this->start_date->format('Y') . ' - ' . $this->end_date->format('Y');
    }

    /**
     * Scope for active education
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for ordered education
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
