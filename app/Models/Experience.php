<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'company_name' => 'array',
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
     * Get company name for specific language
     */
    public function getCompanyName($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->company_name[$lang] ?? $this->company_name['az'] ?? '';
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
     * Check if experience is ongoing
     */
    public function isOngoing()
    {
        return is_null($this->end_date);
    }

    /**
     * Get experience duration
     */
    public function getDuration()
    {
        if ($this->isOngoing()) {
            return $this->start_date->format('Y') . ' - ' . 'Davam edir';
        }
        
        return $this->start_date->format('Y') . ' - ' . $this->end_date->format('Y');
    }

    /**
     * Scope for active experience
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for ordered experience
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
