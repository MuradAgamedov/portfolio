<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'title' => [
                    'en' => 'Micro Site',
                    'az' => 'Mikro sayt',
                    'ru' => 'Микро сайт'
                ],
                'price' => [
                    'en' => '70 AZN',
                    'az' => '70 AZN',
                    'ru' => '70 AZN'
                ],
                'order' => 1,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Mini Presence',
                    'az' => 'Mini Mövcudluq',
                    'ru' => 'Мини присутствие'
                ],
                'price' => [
                    'en' => '100 AZN',
                    'az' => '100 AZN',
                    'ru' => '100 AZN'
                ],
                'order' => 2,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Simple Info',
                    'az' => 'Sadə Məlumat',
                    'ru' => 'Простая информация'
                ],
                'price' => [
                    'en' => '140 AZN',
                    'az' => '140 AZN',
                    'ru' => '140 AZN'
                ],
                'order' => 3,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Basic Presence',
                    'az' => 'Əsas Mövcudluq',
                    'ru' => 'Основное присутствие'
                ],
                'price' => [
                    'en' => '180 AZN',
                    'az' => '180 AZN',
                    'ru' => '180 AZN'
                ],
                'order' => 4,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Corporate Lite',
                    'az' => 'Korporativ Lite',
                    'ru' => 'Корпоративный Lite'
                ],
                'price' => [
                    'en' => '220 AZN',
                    'az' => '220 AZN',
                    'ru' => '220 AZN'
                ],
                'order' => 5,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Corporate Pro',
                    'az' => 'Korporativ Pro',
                    'ru' => 'Корпоративный Pro'
                ],
                'price' => [
                    'en' => '250 AZN',
                    'az' => '250 AZN',
                    'ru' => '250 AZN'
                ],
                'order' => 6,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Business Site',
                    'az' => 'Biznes Saytı',
                    'ru' => 'Бизнес сайт'
                ],
                'price' => [
                    'en' => '280 AZN',
                    'az' => '280 AZN',
                    'ru' => '280 AZN'
                ],
                'order' => 7,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Advanced Corporate',
                    'az' => 'Qabaqcıl Korporativ',
                    'ru' => 'Продвинутый корпоративный'
                ],
                'price' => [
                    'en' => '320 AZN',
                    'az' => '320 AZN',
                    'ru' => '320 AZN'
                ],
                'order' => 8,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Blog Site',
                    'az' => 'Bloq Tipli Sayt',
                    'ru' => 'Блог сайт'
                ],
                'price' => [
                    'en' => '380 AZN',
                    'az' => '380 AZN',
                    'ru' => '380 AZN'
                ],
                'order' => 9,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Portfolio Site',
                    'az' => 'Portfolio Tipli Sayt',
                    'ru' => 'Сайт портфолио'
                ],
                'price' => [
                    'en' => '390 AZN',
                    'az' => '390 AZN',
                    'ru' => '390 AZN'
                ],
                'order' => 10,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Start Store',
                    'az' => 'Mağazaya Başlayın',
                    'ru' => 'Начните магазин'
                ],
                'price' => [
                    'en' => '450 AZN',
                    'az' => '450 AZN',
                    'ru' => '450 AZN'
                ],
                'order' => 11,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Shop Pro',
                    'az' => 'Shop Pro',
                    'ru' => 'Shop Pro'
                ],
                'price' => [
                    'en' => '550 AZN',
                    'az' => '550 AZN',
                    'ru' => '550 AZN'
                ],
                'order' => 12,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Portal Lite',
                    'az' => 'Portal Lite',
                    'ru' => 'Портал Lite'
                ],
                'price' => [
                    'en' => '600 AZN',
                    'az' => '600 AZN',
                    'ru' => '600 AZN'
                ],
                'order' => 13,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Portal Pro',
                    'az' => 'Portal Pro',
                    'ru' => 'Портал Pro'
                ],
                'price' => [
                    'en' => '650 AZN',
                    'az' => '650 AZN',
                    'ru' => '650 AZN'
                ],
                'order' => 14,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Multi-Section Platform',
                    'az' => 'Çox Bölməli Platforma',
                    'ru' => 'Многосекционная платформа'
                ],
                'price' => [
                    'en' => '730 AZN',
                    'az' => '730 AZN',
                    'ru' => '730 AZN'
                ],
                'order' => 15,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Most Popular',
                    'az' => 'Ən Popular',
                    'ru' => 'Самый популярный'
                ],
                'price' => [
                    'en' => '930 AZN',
                    'az' => '930 AZN',
                    'ru' => '930 AZN'
                ],
                'order' => 16,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Custom Lite',
                    'az' => 'Xüsusi Lite',
                    'ru' => 'Кастомный Lite'
                ],
                'price' => [
                    'en' => '2500 AZN',
                    'az' => '2500 AZN',
                    'ru' => '2500 AZN'
                ],
                'order' => 17,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Premium Corporate',
                    'az' => 'Premium Corporate',
                    'ru' => 'Премиум корпоративный'
                ],
                'price' => [
                    'en' => '3500 AZN',
                    'az' => '3500 AZN',
                    'ru' => '3500 AZN'
                ],
                'order' => 18,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Premium E-commerce',
                    'az' => 'Premium E-commerce',
                    'ru' => 'Премиум электронная коммерция'
                ],
                'price' => [
                    'en' => '5000 AZN',
                    'az' => '5000 AZN',
                    'ru' => '5000 AZN'
                ],
                'order' => 19,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Business Pro Platform',
                    'az' => 'Business Pro Platform',
                    'ru' => 'Бизнес Pro платформа'
                ],
                'price' => [
                    'en' => '7000 AZN',
                    'az' => '7000 AZN',
                    'ru' => '7000 AZN'
                ],
                'order' => 20,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Enterprise Portal',
                    'az' => 'Enterprise Portal',
                    'ru' => 'Корпоративный портал'
                ],
                'price' => [
                    'en' => '9500 AZN',
                    'az' => '9500 AZN',
                    'ru' => '9500 AZN'
                ],
                'order' => 21,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'SaaS Platform',
                    'az' => 'SaaS Platform',
                    'ru' => 'SaaS платформа'
                ],
                'price' => [
                    'en' => '12000 AZN',
                    'az' => '12000 AZN',
                    'ru' => '12000 AZN'
                ],
                'order' => 22,
                'status' => true
            ],
            [
                'title' => [
                    'en' => 'Ultra Enterprise Solution',
                    'az' => 'Ultra Enterprise Solution',
                    'ru' => 'Ультра корпоративное решение'
                ],
                'price' => [
                    'en' => '20000 AZN',
                    'az' => '20000 AZN',
                    'ru' => '20000 AZN'
                ],
                'order' => 23,
                'status' => true
            ]
        ];

        foreach ($plans as $plan) {
            PricingPlan::create($plan);
        }
    }
}
