<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\HeroDataController;
use App\Http\Controllers\Admin\HeroProfessionController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\FrontController;

// Front-end Routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/contact', [FrontController::class, 'contact'])->name('contact.send');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
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
    Route::resource('portfolios', PortfolioController::class);
    Route::post('portfolios/reorder', [PortfolioController::class, 'reorder'])->name('portfolios.reorder');
    
    // Certificate Routes
    Route::resource('certificates', CertificateController::class);
    Route::post('certificates/reorder', [CertificateController::class, 'reorder'])->name('certificates.reorder');
    
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
});
