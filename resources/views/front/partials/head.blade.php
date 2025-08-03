<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $favicon = \App\Models\SiteSetting::getByKey('favicon');
    $seoSettings = \App\Models\SeoSite::first();
    $phone = \App\Models\SiteSetting::getByKey('phone') ?: '994501234567';
@endphp

<!-- Default Title -->
<title>@yield('title', 'Portfolio')</title>

<!-- Favicon -->
@if($favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $favicon) }}">
@endif

<!-- Robots Meta Tag -->
@if($seoSettings && (!$seoSettings->index || !$seoSettings->follow))
    <meta name="robots" content="{{ $seoSettings->index ? 'index' : 'noindex' }},{{ $seoSettings->follow ? 'follow' : 'nofollow' }}">
@endif

<!-- Page Header Code -->
@if($seoSettings && $seoSettings->page_header)
    {!! $seoSettings->page_header !!}
@endif

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Flag Icons CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<!-- Blog Cards CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/blog-cards.css') }}">
<!-- Floating Contact CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/floating-contact.css') }}">

@yield('styles')
@stack('styles')
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
    
    /* Logo Styles */
    .logo {
        display: flex;
        align-items: center;
    }
    
    .logo a {
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .logo-text {
        color: #ffffff;
        font-size: 18px;
        font-weight: 600;
        font-family: var(--font-secondary);
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    
    .logo:hover .logo-text {
        color: #dc3545;
    }
    
    .logo img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .logo:hover img {
        transform: scale(1.1);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    /* Mobile logo styles */
    .mobile-logo a {
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .mobile-logo img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .mobile-logo:hover img {
        transform: scale(1.1);
        border-color: rgba(255, 255, 255, 0.5);
    }
    
    .mobile-logo-text {
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--font-secondary);
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .mobile-logo:hover .mobile-logo-text {
        color: #dc3545;
    }
    
    /* Navigation Menu Typography Styles */
    .primary-menu {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important; /* Sözlər arası məsafə xeyli azaldıldı */
        
        list-style: none !important;
        padding: 0 !important;
        margin-left: 0 !important;
    }
        .mainmenu-nav .primary-menu {
            margin: -16px !important;
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
    
    /* Custom typing animation styles */
    .cd-words-wrapper {
        position: relative;
        display: inline-block;
        min-width: 200px; /* Minimum genişlik */
    }
    
    .cd-words-wrapper b {
        display: inline-block;
        position: absolute;
        white-space: nowrap;
        left: 0;
        top: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
    }
    
    .cd-words-wrapper b.is-visible {
        position: relative;
        opacity: 1;
        visibility: visible;
    }
    
    .cd-words-wrapper b.is-hidden {
        opacity: 0;
        visibility: hidden;
    }
    
    /* Typing cursor effect */
    .cd-words-wrapper::after {
        content: '';
        position: absolute;
        right: -5px;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: #ff014f;
        animation: blink 1s infinite;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    /* Navbar link fixes */
    .onepagenav a[href^="#"] {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .onepagenav a[href^="#"]:hover {
        color: #ff014f !important;
    }
    
    /* Ensure sections have proper IDs */
    section[id] {
        scroll-margin-top: 100px;
    }
    
    /* Hide contact button on mobile */
    @media (max-width: 991px) {
        .buy-now-btn {
            display: none !important;
        }
    }
    
    .primary-menu .nav-item .nav-link {
        text-transform: uppercase !important;
        letter-spacing: 1px !important; /* Hərflər arası məsafə azaldıldı */
        font-weight: 600 !important; /* Qalın font */
        font-size: 12px !important;
        color: #ffffff !important; /* Ağ rəng */
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        padding: 8px 12px !important; /* Padding azaldıldı */
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
        font-weight: 700 !important; /* Hover zamanı daha qalın */
    }
    
    .primary-menu .nav-item .nav-link:hover {
        color: #dc3545 !important;
    }
    
    /* Active state for navigation links */
    .primary-menu .nav-item .nav-link.active {
        color: #dc3545 !important;
        font-weight: 700 !important;
        position: relative;
    }
    
    .primary-menu .nav-item .nav-link.active::after {
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
    .primary-menu .nav-link {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .primary-menu .nav-link.active,
    .primary-menu .nav-link:hover {
        color: #dc3545 !important;
        font-weight: 600;
    }
    
    .primary-menu .nav-link.active::after,
    .primary-menu .nav-link:hover::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 2px;
        background-color: #dc3545;
        border-radius: 1px;
        transition: all 0.3s ease;
        opacity: 1;
    }
    
    .primary-menu .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background-color: #dc3545;
        border-radius: 1px;
        transition: all 0.3s ease;
        opacity: 0;
    }
    
    /* Mobile menu active state */
    .mobile-menu-list li {
        position: relative;
        margin: 5px 0;
    }
    
    .mobile-menu-list li a {
        display: block;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        text-decoration: none;
    }
    
    .mobile-menu-list li a:hover {
        background: rgba(220, 53, 69, 0.05);
        color: #dc3545;
    }
    
    .mobile-menu-list li a.active {
        color: #dc3545 !important;
        font-weight: 600;
        background: rgba(220, 53, 69, 0.1);
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .mobile-menu-list li a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 20px;
        background-color: #dc3545;
        border-radius: 2px;
    }
    
    /* Smooth scroll animation */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 100px;
    }
    
    /* Custom smooth scroll for better performance */
    body {
        scroll-behavior: smooth;
    }
    
    /* Header Scroll Effect Styles */
    .rn-header {
        transition: all 0.3s ease;
        background: transparent;
    }
    
    .rn-header.scrolled {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        background: #212428;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* Add padding to body when header is fixed */
    body.header-fixed {
        padding-top: 80px;
    }
    
    /* Language Switcher Styles */
    .language-switcher {
        margin-right: 15px;
        position: relative;
        z-index: 1000;
    }
    
    .language-switcher .dropdown {
        position: relative;
    }
    
    .language-switcher .dropdown-menu {
        background: var(--background-color-2) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        border-radius: 8px !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3) !important;
        backdrop-filter: blur(10px) !important;
        min-width: 120px !important;
        max-width: 150px !important;
        margin-top: 5px !important;
        padding: 4px !important;
        animation: fadeInDown 0.3s ease !important;
        overflow: hidden !important;
        position: absolute !important;
        right: 0 !important;
        left: auto !important;
        transform: none !important;
        inset: auto !important;
    }
    
    .language-switcher .dropdown-item {
        color: white !important;
        padding: 8px 12px !important;
        transition: all 0.3s ease !important;
        font-size: 13px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        border-radius: 4px !important;
        margin: 2px 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        width: 100% !important;
        box-sizing: border-box !important;
        text-decoration: none !important;
        border: none !important;
        background: transparent !important;
    }
    
    .language-switcher .dropdown-item:hover {
        background: rgba(255,255,255,0.1) !important;
        color: white !important;
        transform: translateX(3px) !important;
    }
    
    .language-switcher .dropdown-item.active {
        background: linear-gradient(135deg, #dc3545, #c82333) !important;
        color: white !important;
        font-weight: 600 !important;
    }
    
    .current-lang {
        margin-left: 4px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .language-switcher .btn i {
        font-size: 16px;
    }
    
    /* Animation for dropdown */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Footer Copyright Styles */
    .footer-copyright a span {
        color: #dc3545 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
    }
    
    .footer-copyright a:hover span {
        color: #c82333 !important;
        transform: scale(1.05) !important;
    }
    
    /* Service Icons Height */
    .rn-service .inner .icon img {
        height: 120px !important;
        width: auto !important;
        object-fit: contain !important;
        display: block !important;
        margin: 0 auto !important;
    }
    
    /* Custom Certificate Slider Styles */
    .custom-certificates-slider {
        margin-top: 50px;
        position: relative;
        padding: 0 60px;
    }
    
    .slider-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    

    
    .certificate-slide {
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    
    .certificate-slide.active {
        display: block;
        opacity: 1;
    }
    

    
    .certificate-card {
        background: #212428;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.1);
        position: relative;
        overflow: hidden;
        min-height: 400px;
    }
    
    .certificate-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #dc3545, #ff6b35);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .certificate-card:hover::before {
        transform: scaleX(1);
    }
    

    
    .certificate-card .inner {
        display: flex;
        align-items: center;
        gap: 40px;
        height: 100%;
    }
    
    .certificate-card .certificate-image {
        flex: 0 0 300px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        position: relative;
    }
    
    .certificate-card .certificate-image img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
    
    .certificate-card .certificate-image img:hover {
        opacity: 0.8;
    }
    
    /* Certificate Modal Styles */
    .certificate-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    
    .certificate-modal.active {
        display: flex;
    }
    
    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
    }
    
    .modal-content {
        position: relative;
        background: #212428;
        border-radius: 15px;
        max-width: 90%;
        max-height: 90%;
        width: auto;
        height: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .modal-title {
        color: #ffffff;
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    
    .modal-close {
        background: transparent;
        border: none;
        color: #c4cfde;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-close:hover {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .modal-body {
        padding: 25px;
        text-align: center;
    }
    
    .modal-image {
        max-width: 100%;
        max-height: 70vh;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .certificate-card .certificate-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .certificate-card .title {
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.2;
    }
    
    .certificate-card .date {
        color: #dc3545;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 25px;
        display: block;
        padding: 8px 16px;
        background: rgba(220, 53, 69, 0.1);
        border-radius: 25px;
        width: fit-content;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }
    
    .certificate-card .description {
        color: #c4cfde;
        font-size: 16px;
        line-height: 1.7;
        margin: 0;
    }
    
    /* Custom Slider Navigation */
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: #212428;
        border: 2px solid rgba(220, 53, 69, 0.3);
        border-radius: 50%;
        color: #dc3545;
        transition: all 0.3s ease;
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .slider-nav svg {
        width: 20px;
        height: 20px;
        transition: all 0.3s ease;
    }
    

    
    .slider-nav.prev-btn {
        left: -60px;
    }
    
    .slider-nav.next-btn {
        right: -60px;
    }
    
    /* Custom Slider Dots */
    .slider-dots {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }
    
    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(220, 53, 69, 0.3);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .dot.active {
        background: #dc3545;
        transform: scale(1.2);
    }
    

    

    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .certificate-card {
            padding: 25px;
            min-height: auto;
        }
        
        .certificate-card .inner {
            flex-direction: column;
            gap: 25px;
            text-align: center;
        }
        
        .certificate-card .certificate-image {
            flex: 0 0 auto;
            width: 100%;
            max-width: 250px;
            margin: 0 auto;
        }
        
        .certificate-card .certificate-image img {
            height: 200px;
        }
        

        
        .certificate-card .title {
            font-size: 22px;
        }
        
        .certificate-card .description {
            font-size: 14px;
        }
        
        .custom-certificates-slider {
            padding: 0 20px;
            padding-bottom: 80px;
        }
        
        .slider-nav {
            top: auto;
            bottom: 20px;
            transform: none;
            width: 40px;
            height: 40px;
        }
        
        .slider-nav svg {
            width: 16px;
            height: 16px;
        }
        
        .slider-nav.prev-btn {
            left: 20px;
        }
        
        .slider-nav.next-btn {
            right: 20px;
        }
        

        
        .slider-dots {
            bottom: -60px;
        }
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
        
        .language-switcher .dropdown-menu {
            min-width: 100px;
            max-width: 120px;
            right: 0;
            left: auto;
        }
        
        .language-switcher .dropdown-item {
            font-size: 12px;
            padding: 6px 10px;
        }
    }
    
    /* Ensure dropdown doesn't overflow on smaller screens */
    @media (max-width: 480px) {
        .language-switcher .dropdown-menu {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            right: auto;
            min-width: 200px;
            max-width: 250px;
            z-index: 9999;
        }
    }
    
    /* Mobile Language Switcher Styles */
    .mobile-language-switcher {
        margin: 20px 0;
        padding: 20px 0;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    
    .mobile-language-switcher h4 {
        color: var(--color-heading);
        font-size: 16px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .mobile-lang-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .mobile-lang-option {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        color: var(--color-body);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }
    
    .mobile-lang-option:hover {
        background: rgba(255,255,255,0.1);
        color: var(--color-heading);
        transform: translateY(-2px);
    }
    
    .mobile-lang-option.active {
        background: var(--color-primary);
        color: white;
        border-color: var(--color-primary);
    }
    
    .mobile-lang-option .flag-icon {
        width: 20px;
        height: 15px;
        border-radius: 2px;
    }
    
    /* Hover effects for language switcher */
    .language-switcher .dropdown-item.hover-effect,
    .mobile-lang-option.hover-effect {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    /* Flag icon improvements */
    .flag-icon {
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.2);
    }
    </style>
