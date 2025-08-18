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
