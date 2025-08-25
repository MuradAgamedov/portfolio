<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\PricingPlanFeature;
use Illuminate\Database\Seeder;

class PricingPlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing features first
        PricingPlanFeature::truncate();

        $features = [
            // 1. Micro Site (ID: 1)
            1 => [
                ['title' => ['en' => '1 page', 'az' => '1 səhifə', 'ru' => '1 страница']],
                ['title' => ['en' => 'Template design', 'az' => 'Template dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 5 days', 'az' => 'Hazırlanma vaxtı: 5 gün', 'ru' => 'Время разработки: 5 дней']],
            ],

            // 2. Mini Presence (ID: 2)
            2 => [
                ['title' => ['en' => '2 pages', 'az' => '2 səhifə', 'ru' => '2 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Template dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 6 days', 'az' => 'Hazırlanma vaxtı: 6 gün', 'ru' => 'Время разработки: 6 дней']],
            ],

            // 3. Simple Info (ID: 3)
            3 => [
                ['title' => ['en' => '3 pages', 'az' => '3 səhifə', 'ru' => '3 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 6 days', 'az' => 'Hazırlanma vaxtı: 6 gün', 'ru' => 'Время разработки: 6 дней']],
            ],

            // 4. Basic Presence (ID: 4)
            4 => [
                ['title' => ['en' => '4 pages', 'az' => '4 səhifə', 'ru' => '4 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 7 days', 'az' => 'Hazırlanma vaxtı: 7 gün', 'ru' => 'Время разработки: 7 дней']],
            ],

            // 5. Corporate Lite (ID: 5)
            5 => [
                ['title' => ['en' => '5 pages', 'az' => '5 səhifə', 'ru' => '5 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 8 days', 'az' => 'Hazırlanma vaxtı: 8 gün', 'ru' => 'Время разработки: 8 дней']],
            ],

            // 6. Corporate Pro (ID: 6)
            6 => [
                ['title' => ['en' => '6 pages', 'az' => '6 səhifə', 'ru' => '6 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 9 days', 'az' => 'Hazırlanma vaxtı: 9 gün', 'ru' => 'Время разработки: 9 дней']],
            ],

            // 7. Business Site (ID: 7)
            7 => [
                ['title' => ['en' => '7 pages', 'az' => '7 səhifə', 'ru' => '7 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 10 days', 'az' => 'Hazırlanma vaxtı: 10 gün', 'ru' => 'Время разработки: 10 дней']],
            ],

            // 8. Advanced Corporate (ID: 8)
            8 => [
                ['title' => ['en' => '8 pages', 'az' => '8 səhifə', 'ru' => '8 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 11 days', 'az' => 'Hazırlanma vaxtı: 11 gün', 'ru' => 'Время разработки: 11 дней']],
            ],

            // 9. Blog Site (ID: 9)
            9 => [
                ['title' => ['en' => '9 pages', 'az' => '9 səhifə', 'ru' => '9 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Search and categories', 'az' => 'Axtarış və kateqoriyalar', 'ru' => 'Поиск и категории']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 11 days', 'az' => 'Hazırlanma vaxtı: 11 gün', 'ru' => 'Время разработки: 11 дней']],
            ],

            // 10. Portfolio Site (ID: 10)
            10 => [
                ['title' => ['en' => '10 pages', 'az' => '10 səhifə', 'ru' => '10 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Project filtering and gallery', 'az' => 'Layihə filtrləmə və qalereya', 'ru' => 'Фильтрация проектов и галерея']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 12 days', 'az' => 'Hazırlanma vaxtı: 12 gün', 'ru' => 'Время разработки: 12 дней']],
            ],

            // 11. Start Store (ID: 11)
            11 => [
                ['title' => ['en' => '11 pages', 'az' => '11 səhifə', 'ru' => '11 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Products, cart, order form', 'az' => 'Məhsullar, səbət, sifariş forması', 'ru' => 'Товары, корзина, форма заказа']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 13 days', 'az' => 'Hazırlanma vaxtı: 13 gün', 'ru' => 'Время разработки: 13 дней']],
            ],

            // 12. Shop Pro (ID: 12)
            12 => [
                ['title' => ['en' => '13 pages', 'az' => '13 səhifə', 'ru' => '13 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Products, cart, order form', 'az' => 'Məhsullar, səbət, sifariş forması', 'ru' => 'Товары, корзина, форма заказа']],
                ['title' => ['en' => 'Checkout and payment integration', 'az' => 'Checkout və ödəniş inteqrasiyası', 'ru' => 'Оформление заказа и интеграция платежей']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 14 days', 'az' => 'Hazırlanma vaxtı: 14 gün', 'ru' => 'Время разработки: 14 дней']],
            ],

            // 13. Portal Lite (ID: 13)
            13 => [
                ['title' => ['en' => '14 pages', 'az' => '14 səhifə', 'ru' => '14 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Products, cart, order form', 'az' => 'Məhsullar, səbət, sifariş forması', 'ru' => 'Товары, корзина, форма заказа']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 15 days', 'az' => 'Hazırlanma vaxtı: 15 gün', 'ru' => 'Время разработки: 15 дней']],
            ],

            // 14. Portal Pro (ID: 14)
            14 => [
                ['title' => ['en' => '15 pages', 'az' => '15 səhifə', 'ru' => '15 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Registration and user pages', 'az' => 'Qeydiyyat və istifadəçi yönümlü səhifələr', 'ru' => 'Регистрация и пользовательские страницы']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 16 days', 'az' => 'Hazırlanma vaxtı: 16 gün', 'ru' => 'Время разработки: 16 дней']],
            ],

            // 15. Multi-Section Platform (ID: 15)
            15 => [
                ['title' => ['en' => '16 pages', 'az' => '16 səhifə', 'ru' => '16 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Products, cart, order form', 'az' => 'Məhsullar, səbət, sifariş forması', 'ru' => 'Товары, корзина, форма заказа']],
                ['title' => ['en' => 'Course, blog and product sections mix', 'az' => 'Kurs, bloq və məhsul bölmələrinin qarışığı', 'ru' => 'Смесь курсов, блога и товарных разделов']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 22 days', 'az' => 'Hazırlanma vaxtı: 22 gün', 'ru' => 'Время разработки: 22 дней']],
            ],

            // 16. Most Popular (ID: 16)
            16 => [
                ['title' => ['en' => '20 pages', 'az' => '20 səhifə', 'ru' => '20 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizaynı', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Search and categories', 'az' => 'Axtarış və kateqoriyalar', 'ru' => 'Поиск и категории']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
            ],

            // 17. Custom Lite (ID: 17)
            17 => [
                ['title' => ['en' => '6 pages', 'az' => '6 səhifə', 'ru' => '6 страниц']],
                ['title' => ['en' => 'Fully custom design (UI/UX)', 'az' => 'Tam fərdi dizayn (UI/UX)', 'ru' => 'Полностью кастомный дизайн (UI/UX)']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO-based structure', 'ru' => 'SEO-структура']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
            ],

            // 18. Premium Corporate (ID: 18)
            18 => [
                ['title' => ['en' => '10 pages', 'az' => '10 səhifə', 'ru' => '10 страниц']],
                ['title' => ['en' => 'Fully custom design (UI/UX)', 'az' => 'Tam fərdi dizayn (UI/UX)', 'ru' => 'Полностью кастомный дизайн (UI/UX)']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Google Analytics + SEO advanced setup', 'az' => 'Google Analytics + SEO advanced setup', 'ru' => 'Google Analytics + продвинутая SEO настройка']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 25 days', 'az' => 'Hazırlanma vaxtı: 25 gün', 'ru' => 'Время разработки: 25 дней']],
            ],

            // 19. Premium E-commerce (ID: 19)
            19 => [
                ['title' => ['en' => '20 pages', 'az' => '20 səhifə', 'ru' => '20 страниц']],
                ['title' => ['en' => 'Unique design', 'az' => 'Unikal dizayn', 'ru' => 'Уникальный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Product, cart, checkout, payment system', 'az' => 'Məhsul, səbət, checkout, ödəniş sistemi', 'ru' => 'Товар, корзина, оформление, платежная система']],
                ['title' => ['en' => 'Stock management + coupon system', 'az' => 'Stok idarəetmə + kupon sistemi', 'ru' => 'Управление складом + система купонов']],
                ['title' => ['en' => 'SEO advanced + speed optimization', 'az' => 'SEO advanced + sürət optimizasiyası', 'ru' => 'Продвинутый SEO + оптимизация скорости']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğunluq', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Development time: 30 days', 'az' => 'Hazırlanma vaxtı: 30 gün', 'ru' => 'Время разработки: 30 дней']],
            ],

            // 20. Business Pro Platform (ID: 20)
            20 => [
                ['title' => ['en' => '25+ pages', 'az' => '25+ səhifə', 'ru' => '25+ страниц']],
                ['title' => ['en' => 'Unique UI/UX design', 'az' => 'Unikal UI/UX dizayn', 'ru' => 'Уникальный UI/UX дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'E-commerce + Blog + CRM integration', 'az' => 'E-commerce + Blog + CRM inteqrasiyası', 'ru' => 'E-commerce + Блог + CRM интеграция']],
                ['title' => ['en' => 'Payment gateways integration', 'az' => 'Ödəniş qapıları inteqrasiyası', 'ru' => 'Интеграция платежных шлюзов']],
                ['title' => ['en' => 'SEO & Digital Marketing Setup', 'az' => 'SEO & Digital Marketing Setup', 'ru' => 'SEO и настройка цифрового маркетинга']],
                ['title' => ['en' => 'Mobile responsive + PWA', 'az' => 'Mobil uyğunluq + PWA', 'ru' => 'Мобильная адаптация + PWA']],
                ['title' => ['en' => 'Development time: 40 days', 'az' => 'Hazırlanma vaxtı: 40 gün', 'ru' => 'Время разработки: 40 дней']],
            ],

            // 21. Enterprise Portal (ID: 21)
            21 => [
                ['title' => ['en' => '30+ pages', 'az' => '30+ səhifə', 'ru' => '30+ страниц']],
                ['title' => ['en' => 'Corporate UI/UX design', 'az' => 'Korporativ UI/UX dizayn', 'ru' => 'Корпоративный UI/UX дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Multi-language support', 'az' => 'Multi-language dəstək', 'ru' => 'Поддержка многоязычности']],
                ['title' => ['en' => 'User management + premium role system', 'az' => 'İstifadəçi idarəetməsi + premium rol sistemi', 'ru' => 'Управление пользователями + премиум система ролей']],
                ['title' => ['en' => 'API integration (ERP/CRM)', 'az' => 'API inteqrasiyası (ERP/CRM)', 'ru' => 'API интеграция (ERP/CRM)']],
                ['title' => ['en' => 'SEO professional setup', 'az' => 'SEO professional setup', 'ru' => 'Профессиональная SEO настройка']],
                ['title' => ['en' => 'Development time: 50 days', 'az' => 'Hazırlanma vaxtı: 50 gün', 'ru' => 'Время разработки: 50 дней']],
            ],

            // 22. SaaS Platform (ID: 22)
            22 => [
                ['title' => ['en' => 'SaaS-based platform (subscription system)', 'az' => 'SaaS əsaslı platforma (abunəlik sistemi)', 'ru' => 'SaaS-платформа (система подписок)']],
                ['title' => ['en' => 'Fully unique design', 'az' => 'Tam unikal dizayn', 'ru' => 'Полностью уникальный дизайн']],
                ['title' => ['en' => 'Admin + Super Admin panel', 'az' => 'Admin + Super Admin panel', 'ru' => 'Админ + Супер Админ панель']],
                ['title' => ['en' => 'Payment and subscription management', 'az' => 'Ödəniş və abunə idarəetməsi', 'ru' => 'Управление платежами и подписками']],
                ['title' => ['en' => 'API for third-party integrations', 'az' => 'API ilə üçüncü tərəf qoşulmalar', 'ru' => 'API для сторонних интеграций']],
                ['title' => ['en' => 'Mobile responsive + Mobile app (iOS/Android Hybrid)', 'az' => 'Mobil uyğunluq + Mobil app (iOS/Android Hybrid)', 'ru' => 'Мобильная адаптация + Мобильное приложение (iOS/Android Hybrid)']],
                ['title' => ['en' => 'Development time: 60 days', 'az' => 'Hazırlanma vaxtı: 60 gün', 'ru' => 'Время разработки: 60 дней']],
            ],

            // 23. Ultra Enterprise Solution (ID: 23)
            23 => [
                ['title' => ['en' => 'Unlimited pages', 'az' => 'Limitsiz səhifə', 'ru' => 'Неограниченное количество страниц']],
                ['title' => ['en' => 'Fully enterprise-level design', 'az' => 'Tam enterprise səviyyəli dizayn', 'ru' => 'Полностью корпоративный дизайн']],
                ['title' => ['en' => 'Admin panel + Multi Admin', 'az' => 'Admin panel + Multi Admin', 'ru' => 'Админ панель + Мульти Админ']],
                ['title' => ['en' => 'CRM, ERP integration', 'az' => 'CRM, ERP inteqrasiyası', 'ru' => 'CRM, ERP интеграция']],
                ['title' => ['en' => 'Mobile App (Native iOS + Android)', 'az' => 'Mobil App (Native iOS + Android)', 'ru' => 'Мобильное приложение (Нативный iOS + Android)']],
                ['title' => ['en' => 'Payment systems + bank integration', 'az' => 'Ödəniş sistemləri + bank inteqrasiyası', 'ru' => 'Платежные системы + банковская интеграция']],
                ['title' => ['en' => 'Multi-language + Multi-currency', 'az' => 'Multi-language + Multi-currency', 'ru' => 'Многоязычность + Мультивалютность']],
                ['title' => ['en' => 'Premium support (1 year)', 'az' => 'Premium dəstək (1 il)', 'ru' => 'Премиум поддержка (1 год)']],
                ['title' => ['en' => 'Development time: 90 days', 'az' => 'Hazırlanma vaxtı: 90 gün', 'ru' => 'Время разработки: 90 дней']],
            ]
        ];

        foreach ($features as $planId => $planFeatures) {
            $pricingPlan = PricingPlan::find($planId);
            
            if ($pricingPlan) {
                foreach ($planFeatures as $index => $feature) {
                    PricingPlanFeature::create([
                        'pricing_plan_id' => $planId,
                        'title' => $feature['title'],
                        'status' => true,
                        'order' => $index + 1
                    ]);
                }
            }
        }
    }
} 