<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroData extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'label',
        'text',
        'image_alt',
        'image'
    ];

    public $translatable = [
        'title',
        'label',
        'text',
        'image_alt'
    ];
}
