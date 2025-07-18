<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PricingPlanFeature extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'pricing_plan_id', 'title', 'status', 'order'
    ];

    public $translatable = [
        'title'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }
}
