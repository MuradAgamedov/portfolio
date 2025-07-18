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
</head>
