<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('front.partials.head')

@yield('meta')

<body class="template-color-1 spybody" data-spy="scroll" data-target=".navbar-example2" data-offset="70">

    @include('front.partials.header')

    <main class="main-page-wrapper">
        @yield('content')
    </main>

    @include('front.partials.footer')

    <!-- Floating Contact Button -->
    <div class="floating-contact-btn">
        <button class="contact-float-btn" id="contactFloatBtn">
            <i data-feather="message-circle"></i>
            <span class="tooltip-text">{{__("Contact Us")}}</span>
        </button>
    </div>
    <!-- End Floating Contact Button -->

    <!-- Contact Popup Modal -->
    <div class="contact-popup-modal" id="contactPopupModal">
        <div class="popup-content">
            <div class="popup-header">
                <h3>{{__("Contact Us")}}</h3>
                <button class="popup-close" id="popupClose">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="popup-body">
                <div class="contact-options">
                    <a href="#contact" class="contact-option" data-action="contact-form">
                        <div class="option-icon">
                            <i data-feather="file-text"></i>
                        </div>
                        <div class="option-content">
                            <h4>{{__("Contact Form")}}</h4>
                            <p>{{__("Fill out our contact form")}}</p>
                        </div>
                    </a>
                    
                    <a href="mailto:{{ $siteSettings->email ?? 'info@example.com' }}" class="contact-option" data-action="email">
                        <div class="option-icon">
                            <i data-feather="mail"></i>
                        </div>
                        <div class="option-content">
                            <h4>{{__("Send Email")}}</h4>
                            <p>{{__("Write us an email")}}</p>
                        </div>
                    </a>
                    
                    @php
                        $phone = \App\Models\SiteSetting::getByKey('phone');
                    @endphp
                    <a href="https://wa.me/{{ $phone ?: '01941043264' }}?text={{ urlencode('Hello! I would like to get in touch with you.') }}" class="contact-option" data-action="whatsapp" target="_blank">
                        <div class="option-icon whatsapp-icon">
                            <i data-feather="message-circle"></i>
                        </div>
                        <div class="option-content">
                            <h4>{{__("WhatsApp")}}</h4>
                            <p>{{__("Chat with us on WhatsApp")}}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Popup Modal -->

    @stack('scripts')
    
    <!-- Floating Contact JavaScript -->
    <script src="{{ asset('assets/js/floating-contact.js') }}"></script>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>

</body>

</html> 