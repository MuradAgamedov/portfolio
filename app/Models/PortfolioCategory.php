<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'order'
    ];

    protected $casts = [
        'title' => 'array',
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }

    public function getTitleAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value);
    }

    // Ensure status is always returned as boolean
    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
}
