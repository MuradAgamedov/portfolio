@extends('front.layouts.master')

@section('title')
{{__("Pricing Plans")}} - {{__("My Services")}}
@endsection

@section('meta')
<meta name="description" content="{{__("View all my pricing plans and services. Choose the perfect plan for your website needs.")}}">
<meta name="keywords" content="{{__("pricing, website development, web design, affordable websites")}}">
@endsection

@section('content')
<!-- Start Pricing Header Area -->
<div class="rn-pricing-header-area rn-section-gap section-separator">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Pricing")}}</span>
                    <h2 class="title">{{__("My Pricing Plans")}}</h2>
                    <p class="description">{{__("Choose the perfect plan for your website needs. All plans include professional design and development.")}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Pricing Header Area -->

<!-- Start Pricing Plans Area -->
<div class="rn-pricing-area rn-section-gap section-separator">
    <div class="container">
        <div class="row mt--50 pricing-area" id="pricingCardsContainer">
            @foreach($pricingPlans as $index => $plan)
            <div class="col-lg-4 col-md-6 col-sm-12 pricing-card-wrapper" data-index="{{ $index }}">
                <div class="pricing-card {{ $index == 1 ? 'pricing-card-hover' : '' }}">
                    <div class="pricing-card-header">
                        <div class="pricing-badge">{{ $index == 1 ? 'Popular' : ($index == 0 ? 'Basic' : ($index == 2 ? 'Premium' : 'Enterprise')) }}</div>
                        <div class="pricing-price">
                            {!! $plan->getTranslation('price', app()->getLocale()) !!}
                        </div>
                        <h3 class="pricing-title">{{ $plan->getTranslation('title', app()->getLocale()) }}</h3>
                    </div>

                    <div class="pricing-card-body">
                        <div class="pricing-features">
                            @foreach($plan->activeFeatures as $feature)
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i data-feather="check"></i>
                                </div>
                                <span class="feature-text">{{ $feature->getTranslation('title', app()->getLocale()) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $phone = \App\Models\SiteSetting::getByKey('phone');
                    @endphp
                    <div class="pricing-card-footer">
                        <a href="https://wa.me/{{ $phone ?: '01941043264' }}?text=Salam! Mən {{ $plan->getTranslation('title', app()->getLocale()) }} planı haqqında məlumat almaq istəyirəm." class="rn-btn d-block" target="_blank">
                            <span>{{__("Get Started")}}</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Pricing Plans Area -->

<!-- Start Contact CTA Area -->
<div class="rn-cta-area rn-section-gap section-separator">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-content text-center">
                    <h3 class="title">{{__("Need a Custom Solution?")}}</h3>
                    <p class="description">{{__("Don't see a plan that fits your needs? Let's discuss a custom solution tailored to your requirements.")}}</p>
                    <div class="cta-buttons">
                        <a href="{{ localized_route('contact') }}" class="rn-btn">
                            <span>{{__("Contact Me")}}</span>
                            <i data-feather="mail"></i>
                        </a>
                        <a href="https://wa.me/{{ $phone ?: '01941043264' }}?text=Salam! Mən custom həll haqqında danışmaq istəyirəm." class="rn-btn rn-btn-outline" target="_blank">
                            <span>{{__("WhatsApp")}}</span>
                            <i data-feather="message-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact CTA Area -->
@endsection

@push('styles')
<style>
/* Pricing Header Styles */
.rn-pricing-header-area {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    padding: 80px 0;
}

.rn-pricing-header-area .section-title .description {
    color: var(--color-body);
    font-size: 18px;
    margin-top: 20px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Pricing Card Styles - Same as Home Page */
.pricing-card-hover {
    transition: all 0.3s ease;
    transform: scale(1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.pricing-card-hover:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    border: 2px solid var(--color-primary);
    background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.05) 0%, rgba(var(--color-primary-rgb), 0.1) 100%);
}

.pricing-card-hover:hover .pricing-badge {
    background: var(--color-primary);
    color: white;
}

.pricing-card-hover:hover .pricing-title {
    color: var(--color-primary);
}

.pricing-card-hover:hover .rn-btn {
    background: var(--color-primary);
    color: white;
}

/* Pricing Features Styling */
.pricing-features {
    padding: 0;
    margin: 0;
}

.feature-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.feature-item:last-child {
    border-bottom: none;
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.05);
    padding-left: 10px;
    border-radius: 8px;
}

.feature-icon {
    width: 24px;
    height: 24px;
    background: var(--color-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.feature-icon i {
    width: 14px;
    height: 14px;
    color: white;
    stroke-width: 3;
}

.feature-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    line-height: 1.4;
    flex: 1;
}

.pricing-card-hover:hover .feature-icon {
    background: var(--color-primary);
    transform: scale(1.1);
}

.pricing-card-hover:hover .feature-text {
    color: rgba(255, 255, 255, 0.9);
}

/* Pricing Card Wrapper */
.pricing-card-wrapper {
    transition: all 0.6s ease-out;
    opacity: 1;
    transform: translateY(0);
    margin-bottom: 30px;
}

/* Basic Pricing Card Styles */
.pricing-card {
    background: linear-gradient(135deg, #212428 0%, #1d1f23 100%);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.pricing-card-header {
    text-align: center;
    margin-bottom: 25px;
}

.pricing-badge {
    display: inline-block;
    background: rgba(255, 1, 79, 0.1);
    color: var(--color-primary);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
    border: 1px solid rgba(255, 1, 79, 0.3);
}

.pricing-price {
    font-size: 36px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 15px;
}

.pricing-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--color-heading);
    margin: 0;
}

.pricing-card-body {
    margin-bottom: 25px;
}

.pricing-card-footer {
    text-align: center;
}

.pricing-card-footer .rn-btn {
    width: 100%;
    justify-content: center;
}

/* CTA Area Styles */
.rn-cta-area {
    background: linear-gradient(135deg, rgba(255, 1, 79, 0.1) 0%, rgba(255, 107, 157, 0.1) 100%);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-content .title {
    font-size: 36px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 20px;
}

.cta-content .description {
    font-size: 18px;
    color: var(--color-body);
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.rn-btn-outline {
    background: transparent;
    border: 2px solid var(--color-primary);
    color: var(--color-primary);
}

.rn-btn-outline:hover {
    background: var(--color-primary);
    color: white;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .rn-pricing-header-area {
        padding: 60px 0;
    }
    
    .cta-content .title {
        font-size: 28px;
    }
    
    .cta-content .description {
        font-size: 16px;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons .rn-btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>
@endpush
