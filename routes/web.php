<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\HeroDataController;
use App\Http\Controllers\Admin\HeroProfessionController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SeoSiteController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\PricingPlanFeatureController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BlogController as FrontBlogController;
use App\Http\Controllers\ServiceController as FrontServiceController;
use App\Http\Controllers\ServiceRequestController;

// Redirect root to default language
Route::get('/', function () {
    $defaultLanguage = \App\Models\Language::where('is_main_lang', 1)->first();
    $defaultLang = $defaultLanguage ? $defaultLanguage->lang_code : 'en';
    return redirect('/' . $defaultLang);
});

// Language Switch Route (for AJAX)
Route::get('/language/{lang}', function($lang) {
    // Get available languages from database
    $availableLanguages = \App\Models\Language::where('status', 1)->pluck('lang_code')->toArray();
    
    if (in_array($lang, $availableLanguages)) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('language.switch');

// Localized Front-end Routes
Route::prefix('{locale}')->where(['locale' => '[a-z]{2}'])->middleware(['setlocale'])->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/blogs', [FrontBlogController::class, 'index'])->name('blogs.index');
    Route::get('/blog/{id}/{slug?}', [FrontBlogController::class, 'show'])->name('blog.show');
    Route::get('/services', [FrontServiceController::class, 'index'])->name('services.index');
    Route::get('/portfolios', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
    Route::get('/contact', [FrontController::class, 'contactPage'])->name('contact');
    Route::post('/service-request', [ServiceRequestController::class, 'store'])->name('service-request.store');
    Route::post('/contact', [FrontController::class, 'contact'])->name('contact');
    Route::post('/newsletter', [FrontController::class, 'newsletter'])->name('newsletter');
});

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Redirect to admin login if not authenticated
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('languages', AdminLanguageController::class);
    Route::post('languages/reorder', [AdminLanguageController::class, 'reorder'])->name('languages.reorder');
    
    // Hero Data Routes
    Route::get('/hero/edit', [HeroDataController::class, 'edit'])->name('hero.edit');
    Route::put('/hero/update', [HeroDataController::class, 'update'])->name('hero.update');
    
    // Hero Professions Routes
    Route::resource('hero-professions', HeroProfessionController::class);
    Route::post('hero-professions/reorder', [HeroProfessionController::class, 'reorder'])->name('hero-professions.reorder');
    
    // Socials Routes
    Route::get('/socials/edit', [SocialController::class, 'edit'])->name('socials.edit');
    Route::put('/socials/update', [SocialController::class, 'update'])->name('socials.update');
    
    // Services Routes
    Route::resource('services', ServiceController::class);
    Route::post('services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
    
    // Portfolio Categories Routes
    Route::resource('portfolio-categories', PortfolioCategoryController::class);
    Route::post('portfolio-categories/reorder', [PortfolioCategoryController::class, 'reorder'])->name('portfolio-categories.reorder');
    
    // Portfolio Routes
    Route::resource('portfolios', AdminPortfolioController::class);
    Route::post('portfolios/reorder', [AdminPortfolioController::class, 'reorder'])->name('portfolios.reorder');
    
    // Certificate Routes
    Route::resource('certificates', CertificateController::class);
    Route::post('certificates/reorder', [CertificateController::class, 'reorder'])->name('certificates.reorder');
    
    // Blog Categories Routes
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::post('blog-categories/reorder', [BlogCategoryController::class, 'reorder'])->name('blog-categories.reorder');
    
    // Blog Routes
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/reorder', [BlogController::class, 'reorder'])->name('blogs.reorder');
    
    // Education Routes
    Route::resource('education', EducationController::class);
    Route::post('education/reorder', [EducationController::class, 'reorder'])->name('education.reorder');
    
    // Skill Routes
    Route::resource('skills', SkillController::class);
    Route::post('skills/reorder', [SkillController::class, 'reorder'])->name('skills.reorder');
    
    // Experience Routes
    Route::resource('experiences', ExperienceController::class);
    Route::post('experiences/reorder', [ExperienceController::class, 'reorder'])->name('experiences.reorder');
    
    // About Routes
    Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about/update', [AboutController::class, 'update'])->name('about.update');
    Route::get('about/download-cv', [AboutController::class, 'downloadCv'])->name('about.download-cv');
    
    // Dictionary Routes
    Route::resource('dictionary', DictionaryController::class);
    Route::get('dictionary/generate-files', [DictionaryController::class, 'generateFiles'])->name('dictionary.generate-files');
    
    // Contact Routes
    Route::resource('contacts', ContactController::class);
    Route::patch('contacts/{contact}/mark-as-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-as-read');
    Route::post('contacts/{contact}/reply', [ContactController::class, 'markAsReplied'])->name('contacts.reply');
    Route::get('contacts/filter/unread', [ContactController::class, 'unread'])->name('contacts.unread');
    Route::get('contacts/filter/read', [ContactController::class, 'read'])->name('contacts.read');
    Route::get('contacts/filter/replied', [ContactController::class, 'replied'])->name('contacts.replied');
    
    // Site Settings Routes
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::get('site-settings/initialize', [SiteSettingController::class, 'initialize'])->name('site-settings.initialize');

    // SEO Site Routes
    Route::get('seo-site', [SeoSiteController::class, 'index'])->name('seo-site.index');
    Route::post('seo-site', [SeoSiteController::class, 'update'])->name('seo-site.update');
    
    // Pricing Plans Routes
    Route::resource('pricing-plans', PricingPlanController::class);
    Route::post('pricing-plans/reorder', [PricingPlanController::class, 'updateOrder'])->name('pricing-plans.reorder');
    Route::patch('pricing-plans/{pricingPlan}/toggle-status', [PricingPlanController::class, 'toggleStatus'])->name('pricing-plans.toggle-status');
    
    // Pricing Plan Features Routes
    Route::resource('pricing-plans.features', PricingPlanFeatureController::class)->shallow();
    Route::post('pricing-plans/{pricingPlan}/features/reorder', [PricingPlanFeatureController::class, 'updateOrder'])->name('pricing-plans.features.reorder');
    Route::patch('pricing-plans/{pricingPlan}/features/{feature}/toggle-status', [PricingPlanFeatureController::class, 'toggleStatus'])->name('pricing-plans.features.toggle-status');
    
    // Newsletter Routes
    Route::resource('newsletters', NewsletterController::class)->only(['index', 'destroy']);
    Route::post('newsletters/{newsletter}/toggle-status', [NewsletterController::class, 'toggleStatus'])->name('newsletters.toggle-status');
    
    // Service Requests Routes
    Route::resource('service-requests', ServiceRequestController::class)->only(['index', 'show', 'destroy']);
    Route::patch('service-requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])->name('service-requests.update-status');
    Route::patch('service-requests/{serviceRequest}/mark-as-read', [ServiceRequestController::class, 'markAsRead'])->name('service-requests.mark-as-read');
});
