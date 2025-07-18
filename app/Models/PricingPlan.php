<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PricingPlan extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title', 'price', 'status', 'order'
    ];

    public $translatable = [
        'title', 'price'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function features()
    {
        return $this->hasMany(PricingPlanFeature::class)->orderBy('order');
    }

    public function activeFeatures()
    {
        return $this->hasMany(PricingPlanFeature::class)->where('status', true)->orderBy('order');
    }
}
