<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'title' => 'Azərbaycan dili',
                'lang_code' => 'az',
                'is_main_lang' => true,
                'order' => 1,
                'status' => true
            ],
            [
                'title' => 'English',
                'lang_code' => 'en',
                'is_main_lang' => false,
                'order' => 2,
                'status' => true
            ],
            [
                'title' => 'Русский',
                'lang_code' => 'ru',
                'is_main_lang' => false,
                'order' => 3,
                'status' => true
            ]
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
