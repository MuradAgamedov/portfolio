<?php

namespace App\Traits;

use App\Models\Social;

trait SocialTrait
{
    /**
     * Get active social media links
     */
    protected function getSocials()
    {
        return Social::where('status', true)->orderBy('order')->get();
    }
} 