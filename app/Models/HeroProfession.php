<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroProfession extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public $translatable = [
        'title'
    ];
}
