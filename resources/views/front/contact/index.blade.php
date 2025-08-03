@extends('front.layouts.master')

@section('title', __('seo_contact_title'))

@section('meta')
<meta name="description" content="{{ __('seo_contact_description') }}">
<meta name="keywords" content="{{ __('seo_contact_keywords') }}">
@endsection

@section('content')
@include('front.partials.contact-section')
@endsection

@push('scripts')
<!-- Contact Form JavaScript -->
<script src="{{ asset('assets/js/contact-form.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if URL has #whatsapp hash
    if (window.location.hash === '#whatsapp') {
        setTimeout(() => {
            const whatsappLink = document.getElementById('contact-whatsapp-link');
            if (whatsappLink) {
                whatsappLink.click();
            }
        }, 500);
    }
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/contact-form.css') }}">
@endpush


 