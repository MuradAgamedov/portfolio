<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'percent',
        'status',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'percent' => 'integer',
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
     * Get formatted percentage
     */
    public function getFormattedPercent()
    {
        return $this->percent . '%';
    }

    /**
     * Get progress bar color based on percentage
     */
    public function getProgressColor()
    {
        if ($this->percent >= 80) {
            return 'success';
        } elseif ($this->percent >= 60) {
            return 'info';
        } elseif ($this->percent >= 40) {
            return 'warning';
        } else {
            return 'danger';
        }
    }

    /**
     * Scope for active skills
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for ordered skills
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
