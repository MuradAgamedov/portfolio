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
        $features = [
            // 1. Micro Site (ID: 3)
            3 => [
                ['title' => ['en' => '1 page', 'az' => '1 səhifə', 'ru' => '1 страница']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Mobile responsive', 'az' => 'Mobil uyğun', 'ru' => 'Мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 5 days', 'az' => 'Hazırlanma müddəti: 5 gün', 'ru' => 'Время разработки: 5 дней']],
            ],

            // 2. Mini Presence (ID: 4)
            4 => [
                ['title' => ['en' => '2 pages', 'az' => '2 səhifə', 'ru' => '2 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO-based structure', 'az' => 'SEO əsaslı quruluş', 'ru' => 'SEO-оптимизированная структура']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 6 days', 'az' => 'Hazırlanma müddəti: 6 gün', 'ru' => 'Время разработки: 6 дней']],
            ],

            // 3. Simple Info (ID: 5)
            5 => [
                ['title' => ['en' => '3 pages', 'az' => '3 səhifə', 'ru' => '3 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Basic sections: About, Services, Contact', 'az' => 'Əsas bölmələr: Haqqımızda, Xidmətlər, Əlaqə', 'ru' => 'Основные разделы: О нас, Услуги, Контакты']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 6 days', 'az' => 'Hazırlanma müddəti: 6 gün', 'ru' => 'Время разработки: 6 дней']],
            ],

            // 4. Basic Presence (ID: 6)
            6 => [
                ['title' => ['en' => '4 pages', 'az' => '4 səhifə', 'ru' => '4 страницы']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Additional: Portfolio', 'az' => 'Əlavə: Portfolio', 'ru' => 'Дополнительно: Портфолио']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 7 days', 'az' => 'Hazırlanma müddəti: 7 gün', 'ru' => 'Время разработки: 7 дней']],
            ],

            // 5. Corporate Lite (ID: 7)
            7 => [
                ['title' => ['en' => '5 pages', 'az' => '5 səhifə', 'ru' => '5 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Google Maps + contact form', 'az' => 'Google Maps + əlaqə forması', 'ru' => 'Google Maps + форма обратной связи']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 8 days', 'az' => 'Hazırlanma müddəti: 8 gün', 'ru' => 'Время разработки: 8 дней']],
            ],

            // 6. Corporate Pro (ID: 8)
            8 => [
                ['title' => ['en' => '6 pages', 'az' => '6 səhifə', 'ru' => '6 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO + mobile responsiveness', 'az' => 'SEO + mobil uyğunluq', 'ru' => 'SEO + мобильная адаптация']],
                ['title' => ['en' => 'Domain/hosting not included', 'az' => 'Domen/hosting daxil deyil', 'ru' => 'Домен/хостинг не включен']],
                ['title' => ['en' => 'Development time: 9 days', 'az' => 'Hazırlanma müddəti: 9 gün', 'ru' => 'Время разработки: 9 дней']],
            ],

            // 7. Business Site (ID: 9)
            9 => [
                ['title' => ['en' => '7 pages', 'az' => '7 səhifə', 'ru' => '7 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Blog or Portfolio module', 'az' => 'Blog və ya Portfolio modulu', 'ru' => 'Модуль блога или портфолио']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 10 days', 'az' => 'Hazırlanma müddəti: 10 gün', 'ru' => 'Время разработки: 10 дней']],
            ],

            // 8. Advanced Corporate (ID: 10)
            10 => [
                ['title' => ['en' => '8 pages', 'az' => '8 səhifə', 'ru' => '8 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Integration: social networks + analytics', 'az' => 'İnteqrasiya: sosial şəbəkə + analitika', 'ru' => 'Интеграция: социальные сети + аналитика']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 11 days', 'az' => 'Hazırlanma müddəti: 11 gün', 'ru' => 'Время разработки: 11 дней']],
            ],

            // 9. Blog Site (ID: 11)
            11 => [
                ['title' => ['en' => '9 pages', 'az' => '9 səhifə', 'ru' => '9 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Search and categories', 'az' => 'Axtarış və kateqoriyalar', 'ru' => 'Поиск и категории']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 11 days', 'az' => 'Hazırlanma müddəti: 11 gün', 'ru' => 'Время разработки: 11 дней']],
            ],

            // 10. Portfolio Site (ID: 12)
            12 => [
                ['title' => ['en' => '10 pages', 'az' => '10 səhifə', 'ru' => '10 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Project filtering and gallery', 'az' => 'Layihə filtrləmə və qalereya', 'ru' => 'Фильтрация проектов и галерея']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 12 days', 'az' => 'Hazırlanma müddəti: 12 gün', 'ru' => 'Время разработки: 12 дней']],
            ],

            // 11. Shop Start (ID: 13)
            13 => [
                ['title' => ['en' => '11 pages', 'az' => '11 səhifə', 'ru' => '11 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Products, cart, order form', 'az' => 'Məhsullar, səbət, sifariş forması', 'ru' => 'Товары, корзина, форма заказа']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 13 days', 'az' => 'Hazırlanma müddəti: 13 gün', 'ru' => 'Время разработки: 13 дней']],
            ],

            // 12. Shop Pro (ID: 14)
            14 => [
                ['title' => ['en' => '13 pages', 'az' => '13 səhifə', 'ru' => '13 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Checkout and payment integration', 'az' => 'Checkout və ödəniş inteqrasiyası', 'ru' => 'Оформление заказа и интеграция платежей']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 14 days', 'az' => 'Hazırlanma müddəti: 14 gün', 'ru' => 'Время разработки: 14 дней']],
            ],

            // 13. Portal Lite (ID: 15)
            15 => [
                ['title' => ['en' => '14 pages', 'az' => '14 səhifə', 'ru' => '14 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'News and announcement module', 'az' => 'Xəbər və elan modulu', 'ru' => 'Модуль новостей и объявлений']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 15 days', 'az' => 'Hazırlanma müddəti: 15 gün', 'ru' => 'Время разработки: 15 дней']],
            ],

            // 14. Portal Pro (ID: 16)
            16 => [
                ['title' => ['en' => '15 pages', 'az' => '15 səhifə', 'ru' => '15 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Registration and user-oriented pages', 'az' => 'Qeydiyyat və istifadəçi yönümlü səhifələr', 'ru' => 'Регистрация и пользовательские страницы']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 16 days', 'az' => 'Hazırlanma müddəti: 16 gün', 'ru' => 'Время разработки: 16 дней']],
            ],

            // 15. Multi Section Platform (ID: 17)
            17 => [
                ['title' => ['en' => '16 pages', 'az' => '16 səhifə', 'ru' => '16 страниц']],
                ['title' => ['en' => 'Template design', 'az' => 'Şablon dizayn', 'ru' => 'Шаблонный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Mixed sections: courses, blog, and products', 'az' => 'Kurs, bloq və məhsul bölmələrinin qarışığı', 'ru' => 'Смешанные разделы: курсы, блог и товары']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 18 days', 'az' => 'Hazırlanma müddəti: 18 gün', 'ru' => 'Время разработки: 18 дней']],
            ],

            // 16. Custom Lite (ID: 18)
            18 => [
                ['title' => ['en' => '12 pages', 'az' => '12 səhifə', 'ru' => '12 страниц']],
                ['title' => ['en' => 'Full custom design (UI/UX)', 'az' => 'Tam fərdi dizayn (UI/UX)', 'ru' => 'Полный индивидуальный дизайн (UI/UX)']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'SEO and speed optimization', 'az' => 'SEO və sürət optimizasiya', 'ru' => 'SEO и оптимизация скорости']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 25 days', 'az' => 'Hazırlanma müddəti: 25 gün', 'ru' => 'Время разработки: 25 дней']],
            ],

            // 17. Custom Corporate (ID: 19)
            19 => [
                ['title' => ['en' => '14 pages', 'az' => '14 səhifə', 'ru' => '14 страниц']],
                ['title' => ['en' => 'Full custom design', 'az' => 'Tam fərdi dizayn', 'ru' => 'Полный индивидуальный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Portfolio + blog + services', 'az' => 'Portfolio + bloq + xidmətlər', 'ru' => 'Портфолио + блог + услуги']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 28 days', 'az' => 'Hazırlanma müddəti: 28 gün', 'ru' => 'Время разработки: 28 дней']],
            ],

            // 18. Custom Shop (ID: 20)
            20 => [
                ['title' => ['en' => '16 pages', 'az' => '16 səhifə', 'ru' => '16 страниц']],
                ['title' => ['en' => 'Full custom design', 'az' => 'Tam fərdi dizayn', 'ru' => 'Полный индивидуальный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Full e-commerce + user accounts', 'az' => 'Tam e-commerce + istifadəçi hesabları', 'ru' => 'Полный e-commerce + пользовательские аккаунты']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 30 days', 'az' => 'Hazırlanma müddəti: 30 gün', 'ru' => 'Время разработки: 30 дней']],
            ],

            // 19. Custom Portal (ID: 21)
            21 => [
                ['title' => ['en' => '18 pages', 'az' => '18 səhifə', 'ru' => '18 страниц']],
                ['title' => ['en' => 'Full custom design', 'az' => 'Tam fərdi dizayn', 'ru' => 'Полный индивидуальный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Courses, blogs, announcements, multilingual system', 'az' => 'Kurslar, bloqlar, elanlar, çoxdilli sistem', 'ru' => 'Курсы, блоги, объявления, многоязычная система']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 35 days', 'az' => 'Hazırlanma müddəti: 35 gün', 'ru' => 'Время разработки: 35 дней']],
            ],

            // 20. Ultimate Enterprise (ID: 22)
            22 => [
                ['title' => ['en' => '20+ pages', 'az' => '20+ səhifə', 'ru' => '20+ страниц']],
                ['title' => ['en' => 'Full custom design', 'az' => 'Tam fərdi dizayn', 'ru' => 'Полный индивидуальный дизайн']],
                ['title' => ['en' => 'Admin panel', 'az' => 'Admin panel', 'ru' => 'Админ панель']],
                ['title' => ['en' => 'Integration of all systems: e-commerce, courses, blog, CRM', 'az' => 'Bütün sistemlərin birləşməsi: e-commerce, kurs, bloq, CRM', 'ru' => 'Интеграция всех систем: e-commerce, курсы, блог, CRM']],
                ['title' => ['en' => 'Security + speed + SEO + multilingual support', 'az' => 'Təhlükəsizlik + sürət + SEO + çoxdilli dəstək', 'ru' => 'Безопасность + скорость + SEO + многоязычная поддержка']],
                ['title' => ['en' => 'Free domain and hosting', 'az' => 'Pulsuz domen və hosting', 'ru' => 'Бесплатный домен и хостинг']],
                ['title' => ['en' => 'Development time: 40+ days', 'az' => 'Hazırlanma müddəti: 40+ gün', 'ru' => 'Время разработки: 40+ дней']],
            ],
        ];

        foreach ($features as $pricingPlanId => $planFeatures) {
            $order = 1;
            foreach ($planFeatures as $feature) {
                PricingPlanFeature::create([
                    'pricing_plan_id' => $pricingPlanId,
                    'title' => $feature['title'],
                    'status' => true,
                    'order' => $order++,
                ]);
            }
        }
    }
} 