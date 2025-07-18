<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'platform',
        'url',
        'icon',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    // Platform options
    public static function getPlatforms()
    {
        return [
            'facebook' => [
                'name' => 'Facebook',
                'icon' => 'fab fa-facebook',
                'color' => '#1877f2'
            ],
            'instagram' => [
                'name' => 'Instagram',
                'icon' => 'fab fa-instagram',
                'color' => '#e4405f'
            ],
            'twitter' => [
                'name' => 'Twitter',
                'icon' => 'fab fa-twitter',
                'color' => '#1da1f2'
            ],
            'linkedin' => [
                'name' => 'LinkedIn',
                'icon' => 'fab fa-linkedin',
                'color' => '#0077b5'
            ],
            'github' => [
                'name' => 'GitHub',
                'icon' => 'fab fa-github',
                'color' => '#333'
            ],
            'youtube' => [
                'name' => 'YouTube',
                'icon' => 'fab fa-youtube',
                'color' => '#ff0000'
            ],
            'telegram' => [
                'name' => 'Telegram',
                'icon' => 'fab fa-telegram',
                'color' => '#0088cc'
            ],
            'whatsapp' => [
                'name' => 'WhatsApp',
                'icon' => 'fab fa-whatsapp',
                'color' => '#25d366'
            ],
            'tiktok' => [
                'name' => 'TikTok',
                'icon' => 'fab fa-tiktok',
                'color' => '#000000'
            ],
            'discord' => [
                'name' => 'Discord',
                'icon' => 'fab fa-discord',
                'color' => '#5865f2'
            ]
        ];
    }

    /**
     * Get platform name
     */
    public function getPlatformName()
    {
        $platforms = self::getPlatforms();
        return $platforms[$this->platform]['name'] ?? $this->platform;
    }

    /**
     * Get platform color
     */
    public function getPlatformColor()
    {
        $platforms = self::getPlatforms();
        return $platforms[$this->platform]['color'] ?? '#007bff';
    }
}
