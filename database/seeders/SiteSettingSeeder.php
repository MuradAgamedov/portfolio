<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSettings = [
            [
                'key' => 'favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'logo',
                'sort_order' => 1
            ],
            [
                'key' => 'header_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'logo',
                'sort_order' => 2
            ],
            [
                'key' => 'header_logo_alt',
                'value' => 'Site Logo',
                'translations' => [
                    'en' => 'Site Logo',
                    'az' => 'Sayt Loqosu'
                ],
                'type' => 'text',
                'group' => 'logo',
                'sort_order' => 3
            ],
            [
                'key' => 'footer_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'logo',
                'sort_order' => 4
            ],
            [
                'key' => 'footer_logo_alt',
                'value' => 'Footer Logo',
                'translations' => [
                    'en' => 'Footer Logo',
                    'az' => 'Footer Loqosu'
                ],
                'type' => 'text',
                'group' => 'logo',
                'sort_order' => 5
            ],
            [
                'key' => 'phone',
                'value' => '+1234567890',
                'type' => 'phone',
                'group' => 'contact',
                'sort_order' => 1
            ],
            [
                'key' => 'email',
                'value' => 'info@example.com',
                'type' => 'email',
                'group' => 'contact',
                'sort_order' => 2
            ],
            [
                'key' => 'contact_section_image',
                'value' => '',
                'type' => 'image',
                'group' => 'contact',
                'sort_order' => 3
            ],
            [
                'key' => 'contact_section_alt',
                'value' => 'Contact Section Image',
                'translations' => [
                    'en' => 'Contact Section Image',
                    'az' => 'Əlaqə Bölməsi Şəkli'
                ],
                'type' => 'text',
                'group' => 'contact',
                'sort_order' => 4
            ],
            [
                'key' => 'contact_section_title',
                'value' => 'Contact With Me',
                'translations' => [
                    'en' => 'Contact With Me',
                    'az' => 'Mənimlə Əlaqə'
                ],
                'type' => 'text',
                'group' => 'contact',
                'sort_order' => 5
            ],
            [
                'key' => 'contact_section_text',
                'value' => 'I am available for freelance work. Connect with me via and call in to my account.',
                'translations' => [
                    'en' => 'I am available for freelance work. Connect with me via and call in to my account.',
                    'az' => 'Mən freelance iş üçün mövcudam. Mənimlə əlaqə saxlayın.'
                ],
                'type' => 'textarea',
                'group' => 'contact',
                'sort_order' => 6
            ]
        ];

        foreach ($defaultSettings as $setting) {
            if (!SiteSetting::where('key', $setting['key'])->exists()) {
                SiteSetting::create($setting);
            }
        }
    }
}
