<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $favicon = \App\Models\SiteSetting::getByKey('favicon');
        $seoSettings = \App\Models\SeoSite::first();
    @endphp
    
    <!-- Favicon -->
    @if($favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $favicon) }}">
    @endif
    
    <!-- SEO Meta Tags -->
    @if($seoSettings)
        @if($seoSettings->getTranslation('seo_title', app()->getLocale()))
            <title>{{ $seoSettings->getTranslation('seo_title', app()->getLocale()) }}</title>
        @endif
        
        @if($seoSettings->getTranslation('seo_description', app()->getLocale()))
            <meta name="description" content="{{ $seoSettings->getTranslation('seo_description', app()->getLocale()) }}">
        @endif
        
        @if($seoSettings->getTranslation('seo_keywords', app()->getLocale()))
            <meta name="keywords" content="{{ $seoSettings->getTranslation('seo_keywords', app()->getLocale()) }}">
        @endif
        
        <!-- Robots Meta Tag -->
        @if(!$seoSettings->index || !$seoSettings->follow)
            <meta name="robots" content="{{ $seoSettings->index ? 'index' : 'noindex' }},{{ $seoSettings->follow ? 'follow' : 'nofollow' }}">
        @endif
    @endif
    
    <!-- Page Header Code -->
    @if($seoSettings && $seoSettings->page_header)
        {!! $seoSettings->page_header !!}
    @endif
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    @yield('styles')
    
    <style>
    /* Header BUY NOW Button Styles */
    .buy-now-btn {
        background-color: #343a40 !important;
        color: #dc3545 !important;
        border: 1px solid #dc3545 !important;
        font-weight: bold !important;
        padding: 12px 25px !important;
        border-radius: 5px !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        height: 48px !important;
        line-height: 1 !important;
        margin: 0 !important;
        font-size: 14px !important;
    }
    
    .buy-now-btn:hover {
        background-color: #dc3545 !important;
        color: white !important;
    }
    
    .header-right {
        display: flex;
        align-items: center;
    }
    
    /* Navigation Menu Typography Styles */
    .primary-menu {
        display: flex !important;
        align-items: center !important;
        gap: 25px !important; /* Sözlər arası məsafə azaldıldı */
        
        list-style: none !important;
        padding: 0 !important;
        margin-left: 0 !important;
    }
        .mainmenu-nav .primary-menu {
            margin -16px !important;
        }
    /* Header wrapper alignment */
    .header-wrapper {
        display: flex;
        align-items: center;
        min-height: 80px;
    }
    
    /* Header center alignment */
    .header-center {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }
    
    /* Main menu nav alignment */
    .mainmenu-nav {
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .primary-menu .nav-item {
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .primary-menu .nav-item .nav-link {
        text-transform: uppercase !important;
        letter-spacing: 2px !important; /* Hərflər arası məsafə */
        font-weight: 300 !important; /* İncə font */
        font-size: 12px !important;
        color: #ffffff !important; /* Ağ rəng */
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        padding: 10px 15px !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        height: 100% !important;
        line-height: 1 !important;
        position: relative !important;
        z-index: 10 !important;
    }
    
    .primary-menu .nav-item .nav-link:hover {
        color: #dc3545 !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    .primary-menu .nav-item .nav-link:hover {
        color: #dc3545 !important;
    }
    
    /* Custom Mobile Menu Toggle */
    .mobile-menu-toggle {
        cursor: pointer;
        display: none;
        flex-direction: column;
        justify-content: space-between;
        width: 30px;
        height: 25px;
        background: none;
        border: none;
        padding: 0;
        margin-right: 15px;
    }
    
    .mobile-menu-toggle span {
        display: block;
        width: 100%;
        height: 3px;
        background-color: #fff;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .mobile-menu-toggle:hover span {
        background-color: #dc3545;
    }
    
    /* Custom Mobile Menu */
    .custom-mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .custom-mobile-menu.active {
        opacity: 1;
        visibility: visible;
    }
    
    .mobile-menu-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
    }
    
    .mobile-menu-content {
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 100%;
        background-color: #2c3e50;
        padding: 30px;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        overflow-y: auto;
    }
    
    .custom-mobile-menu.active .mobile-menu-content {
        transform: translateX(0);
    }
    
    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .mobile-logo img {
        max-height: 40px;
        width: auto;
    }
    
    .mobile-menu-close {
        background: none;
        border: none;
        cursor: pointer;
        width: 30px;
        height: 30px;
        position: relative;
    }
    
    .mobile-menu-close span {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #fff;
        transform-origin: center;
    }
    
    .mobile-menu-close span:first-child {
        transform: translateY(-50%) rotate(45deg);
    }
    
    .mobile-menu-close span:last-child {
        transform: translateY(-50%) rotate(-45deg);
    }
    
    .mobile-nav {
        margin-bottom: 40px;
    }
    
    .mobile-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .mobile-menu-list li {
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 15px;
    }
    
    .mobile-menu-list li:last-child {
        border-bottom: none;
    }
    
    .mobile-menu-list a {
        display: block;
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: color 0.3s ease;
    }
    
    .mobile-menu-list a:hover {
        color: #dc3545;
    }
    
    .mobile-social h4 {
        color: #fff;
        font-size: 16px;
        margin-bottom: 20px;
        font-weight: 300;
        letter-spacing: 1px;
    }
    
    .social-links {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .social-link {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .social-link i {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        stroke-width: 2;
        fill: none;
    }
    
    .social-link span {
        font-weight: 300;
        letter-spacing: 1px;
    }
    
    .social-link:hover {
        color: #dc3545;
    }
    
    /* Show mobile menu toggle on mobile */
    @media (max-width: 1199px) {
        .mobile-menu-toggle {
            display: flex !important;
        }
        
        .mainmenu-nav {
            display: none !important;
        }
        
        .header-right {
            gap: 15px;
            justify-content: flex-end;
            padding-right: 20px;
        }
    }
    
    /* Hide mobile menu toggle on desktop */
    @media (min-width: 1200px) {
        .mobile-menu-toggle {
            display: none !important;
        }
        
        .mainmenu-nav {
            display: flex !important;
        }
    }
    
    /* Body styles when menu is open */
    body.menu-open {
        overflow: hidden;
    }
    
    /* Active navigation state */
    .primary-menu .nav-link.active {
        color: #dc3545 !important;
        font-weight: 600;
        position: relative;
    }
    
    .primary-menu .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 2px;
        background-color: #dc3545;
        border-radius: 1px;
    }
    
    /* Smooth scroll animation */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
    }
    
    /* Custom smooth scroll for better performance */
    body {
        scroll-behavior: smooth;
    }
    
    /* Language Switcher Styles */
    .language-switcher {
        margin-right: 15px;
    }
    
    .language-switcher .btn {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 15px;
        transition: all 0.3s ease;
        min-width: auto;
    }
    
    .language-switcher .btn:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.5);
        color: white;
    }
    
    .language-switcher .dropdown-menu {
        background: #2c3e50;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        min-width: 100px;
        padding: 5px 0;
    }
    
    .language-switcher .dropdown-item {
        color: white;
        padding: 6px 12px;
        transition: all 0.3s ease;
        font-size: 12px;
    }
    
    .language-switcher .dropdown-item:hover {
        background: rgba(255,255,255,0.1);
        color: white;
    }
    
    .language-switcher .dropdown-item.active {
        background: #dc3545;
        color: white;
    }
    
    .current-lang {
        margin-left: 4px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .language-switcher .btn i {
        font-size: 16px;
    }
    
    /* Mobile responsive */
    @media (max-width: 768px) {
        .language-switcher {
            margin-right: 8px;
        }
        
        .language-switcher .btn {
            padding: 5px 10px;
            font-size: 11px;
        }
        
        .language-switcher .btn i {
            font-size: 14px;
        }
        
        .current-lang {
            font-size: 12px;
        }
    }
    </style>
</head>
