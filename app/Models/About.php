<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'cv_file',
        'cv_original_name',
        'status',
        'order'
    ];

    protected $casts = [
        'description' => 'array',
        'status' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Get description for specific language
     */
    public function getDescription($lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        return $this->description[$lang] ?? $this->description['az'] ?? '';
    }

    /**
     * Get CV file URL
     */
    public function getCvUrl()
    {
        return $this->cv_file ? asset('storage/' . $this->cv_file) : null;
    }

    /**
     * Get CV file size in MB
     */
    public function getCvSize()
    {
        if (!$this->cv_file) {
            return null;
        }

        $path = storage_path('app/public/' . $this->cv_file);
        if (file_exists($path)) {
            $size = filesize($path);
            return round($size / 1024 / 1024, 2); // Convert to MB
        }

        return null;
    }

    /**
     * Scope for active about
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for ordered about
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
