@extends('front.layouts.master')

@section('title', __('Contact'))

@section('content')
<!-- Start Contact section -->
<div class="rn-contact-area rn-section-gap section-separator" id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Contact")}}</span>
                    @php
                        $contactTitle = \App\Models\SiteSetting::getByKey('title');
                    @endphp
                    <h2 class="title">{{ $contactTitle ?: __("Contact With Me") }}</h2>
                </div>
            </div>
        </div>

        <div class="row mt--50 mt_md--40 mt_sm--40 mt-contact-sm">
            <div class="col-lg-5">
                <div class="contact-about-area">
                    <div class="thumbnail">
                        @php
                            $contactImage = \App\Models\SiteSetting::getByKey('contact_section_image');
                            $contactImageAlt = \App\Models\SiteSetting::getByKey('contact_section_alt');
                        @endphp
                        @if($contactImage)
                            <img src="{{ asset('storage/' . $contactImage) }}" alt="{{ $contactImageAlt ?: 'contact-img' }}">
                        @else
                        <img src="assets/images/contact/contact1.png" alt="contact-img">
                        @endif
                    </div>
                    <div class="title-area">
                        <h4 class="title">{{$contactTitle}}</h4>
                    </div>
                    <div class="description">
                        @php
                            $contactText = \App\Models\SiteSetting::getByKey('contact_section_text');
                            $phone = \App\Models\SiteSetting::getByKey('phone');
                            $email = \App\Models\SiteSetting::getByKey('email');
                        @endphp
                        <p>{{ $contactText ?: __("I am available for freelance work. Connect with me via and call in to my account.") }}</p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <span class="label">{{__("Phone")}}:</span>
                                <a href="tel:{{ $phone ?: '01941043264' }}">{{ $phone ?: '+01234567890' }}</a>
                            </div>
                            <div class="contact-item">
                                <span class="label">{{__("Email")}}:</span>
                                <a href="mailto:{{ $email ?: 'admin@example.com' }}">{{ $email ?: 'admin@example.com' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-form-wrapper">
                    <div class="introduce">
                        <form class="rnt-contact-form rn-form-style-one" action="{{ route('contact') }}" method="POST" id="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="text" name="contact-name" placeholder="{{__('Your Name *')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="email" name="contact-email" placeholder="{{__('Your Email *')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="contact-phone" placeholder="{{__('Your Phone')}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" placeholder="{{__('Subject *')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="contact-message" placeholder="{{__('Your Message *')}}" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button class="rn-btn" type="submit">
                                            <span>{{__("Send Message")}}</span>
                                            <i data-feather="send"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact section -->
@endsection

@section('styles')
<style>
/* Contact Section Styles */
.contact-about-area {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    height: 100%;
}

.contact-about-area .thumbnail {
    text-align: center;
    margin-bottom: 30px;
}

.contact-about-area .thumbnail img {
    max-width: 200px;
    border-radius: 15px;
}

.contact-about-area .title-area {
    text-align: center;
    margin-bottom: 20px;
}

.contact-about-area .title {
    font-size: 24px;
    font-weight: 600;
    color: var(--color-heading);
    margin: 0;
}

.contact-about-area .description {
    text-align: center;
}

.contact-about-area .description p {
    color: var(--color-body);
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 25px;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.contact-item .label {
    font-size: 14px;
    color: var(--color-body);
    font-weight: 500;
}

.contact-item a {
    color: var(--color-primary);
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: color 0.3s ease;
}

.contact-item a:hover {
    color: var(--color-secondary);
}

/* Contact Form Styles */
.contact-form-wrapper {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.form-group {
    margin-bottom: 25px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    color: var(--color-body);
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
    background: rgba(255, 255, 255, 0.1);
}

.form-group textarea {
    min-height: 120px;
    resize: vertical;
}

.rn-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.rn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .contact-about-area,
    .contact-form-wrapper {
        padding: 30px;
    }
    
    .contact-about-area .thumbnail img {
        max-width: 150px;
    }
}

@media only screen and (max-width: 575px) {
    .contact-about-area,
    .contact-form-wrapper {
        padding: 20px;
    }
    
    .contact-about-area .title {
        font-size: 20px;
    }
}
</style>
@endsection 