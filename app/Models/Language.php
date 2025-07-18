<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'title',
        'lang_code',
        'is_main_lang',
        'status'
    ];

    protected $casts = [
        'is_main_lang' => 'boolean',
        'status' => 'boolean',
        'order' => 'integer'
    ];
}
