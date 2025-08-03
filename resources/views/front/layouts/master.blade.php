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
                <!-- Contact Options View -->
                <div class="contact-options" id="contactOptionsView">
                    <a href="#contact" class="contact-option" data-action="contact-form">
                        <div class="option-icon">
                            <i data-feather="file-text"></i>
                        </div>
                        <div class="option-content">
                            <h4>{{__("Contact Form")}}</h4>
                            <p>{{__("Fill out our contact form")}}</p>
                        </div>
                    </a>
                    
                    <a href="#" class="contact-option" data-action="email-form">
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
                    <a href="https://wa.me/{{ $phone ?: '01941043264' }}" class="contact-option" data-action="whatsapp" target="_blank">
                        <div class="option-icon whatsapp-icon">
                            <i data-feather="message-circle"></i>
                        </div>
                        <div class="option-content">
                            <h4>{{__("WhatsApp")}}</h4>
                            <p>{{__("Chat with us on WhatsApp")}}</p>
                        </div>
                    </a>
                </div>

                <!-- Email Form View -->
                <div class="email-form-view" id="emailFormView" style="display: none;">
                    <div class="form-header">
                        <button class="back-btn" id="backToOptions">
                            <i data-feather="arrow-left"></i>
                            <span>{{__("Back")}}</span>
                        </button>
                    </div>
                    <form class="email-form" id="emailForm">
                        <div class="form-group">
                            <label for="email-name">{{__("Full Name")}}</label>
                            <input type="text" id="email-name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email-phone">{{__("Phone Number")}}</label>
                            <input type="tel" id="email-phone" name="phone" class="form-control" required>
                        </div>
                                            <div class="form-group">
                        <label for="email-message">{{__("Message")}}</label>
                        <textarea id="email-message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onFloatingRecaptchaSuccess" data-expired-callback="onFloatingRecaptchaExpired"></div>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i data-feather="send"></i>
                        <span>{{__("Send Email")}}</span>
                    </button>
                    </form>
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