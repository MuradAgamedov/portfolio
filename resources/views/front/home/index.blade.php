@extends('front.layouts.master')

@section('title')
@php
$seoSettings = \App\Models\SeoSite::first();
@endphp
@if($seoSettings && $seoSettings->getTranslation('seo_title', app()->getLocale()))
{{ $seoSettings->getTranslation('seo_title', app()->getLocale()) }}
@else
{{ __('seo_home_title') }}
@endif
@endsection

@section('meta')
@php
$seoSettings = \App\Models\SeoSite::first();
@endphp
@if($seoSettings)
@if($seoSettings->getTranslation('seo_description', app()->getLocale()))
<meta name="description" content="{{ $seoSettings->getTranslation('seo_description', app()->getLocale()) }}">
@endif

@if($seoSettings->getTranslation('seo_keywords', app()->getLocale()))
<meta name="keywords" content="{{ $seoSettings->getTranslation('seo_keywords', app()->getLocale()) }}">
@endif
@endif
@endsection

@section('content')
<style>
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

/* Load More Pricing Cards */
.pricing-card-wrapper {
    transition: all 0.5s ease;
}

.pricing-hidden {
    display: none !important;
}

.pricing-card-wrapper.show {
    display: block !important;
    animation: fadeInUp 0.5s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#loadMorePricing {
    background: var(--color-primary);
    color: white;
    border: 2px solid var(--color-primary);
    transition: all 0.3s ease;
}

#loadMorePricing:hover {
    background: transparent;
    color: var(--color-primary);
}

#loadMorePricing.hidden {
    display: none;
}
</style>

<!-- SEO Display Section -->
@php
$seoSettings = \App\Models\SeoSite::first();
@endphp


<!-- Start Header Area -->
<div id="home" class="rn-slider-area">
    <div class="slide">
        <div class="container">
            <div class="row row--30 align-items-center">
                <div class="order-2 order-lg-1 col-lg-7 mt_md--50 mt_sm--50 mt_lg--30">
                    <div class="content">
                        <div class="inner">
                            <span class="subtitle">{{$heroData->label}}</span>
                            <h1 class="title">{!! $heroData->title !!}<br>
                                <span class="header-caption" id="page-top">
                                    <!-- type headline start-->
                                    <span class="cd-headline clip is-full-width">
                                        <span>a </span>
                                        <!-- ROTATING TEXT -->
                                        <span class="cd-words-wrapper">
                                            @foreach($heroProfessions as $index => $heroProfession)
                                            <b class="{{ $index === 0 ? 'is-visible' : 'is-hidden' }}">{{ $heroProfession->title }}</b>
                                            @endforeach
                                        </span>
                                    </span>
                                    <!-- type headline end -->
                                </span>
                            </h1>

                            <div>
                                <p class="description">{{$heroData->text}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">
                                <div class="social-share-inner-left">
                                    <span class="title">{{__("find with me")}}</span>
                                    <ul class="social-share d-flex liststyle">
                                        @foreach($socials as $social)
                                        <li class="{{ $social->platform }}">
                                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
                                                <i data-feather="{{ $social->platform }}"></i>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{--
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30">
                                <div class="skill-share-inner">
                                    <span class="title">best skill on</span>
                                    <ul class="skill-share d-flex liststyle">
                                        <li><img src="assets/images/icons/icons-01.png" alt="Icons Images"></li>
                                        <li><img src="assets/images/icons/icons-02.png" alt="Icons Images"></li>
                                        <li><img src="assets/images/icons/icons-03.png" alt="Icons Images"></li>
                                    </ul>
                                </div>
                            </div>

                        --}}
                        </div>
                    </div>
                </div>

                <div class="order-1 order-lg-2 col-lg-5">
                    <div class="thumbnail">
                        <div class="inner">
                            <img src="{{asset('storage/'.$heroData->image)}}" alt="{{$heroData->image_alt}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Slider Area -->

<!-- Start Service Area -->
<div class="rn-service-area rn-section-gap section-separator" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left" data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true">
                    <span class="subtitle">{{__("features")}}</span>
                    <h2 class="title">{{__("what i do")}}</h2>
                </div>
            </div>
        </div>
        <div class="row row--25 mt_md--10 mt_sm--10">

            @foreach($services as $index => $service)
            @include('front.partials.service-card', ['service' => $service, 'index' => $index, 'isServicesPage' => false])
            @endforeach

        </div>
    </div>
</div>
<!-- End Service Area  -->


<!-- Start Resume Area -->
<div class="rn-resume-area rn-section-gap section-separator" id="resume">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="flex-direction: column; justify-content:flex-start" class="section-title text-center">
                    <span class="subtitle">{{__("7+ Years of Experience")}}</span>
                    <h2 class="title">{{__("My Resume")}}</h2>
                </div>
            </div>
        </div>
        <div class="row mt--45">
            <div class="col-lg-12">
                <ul class="rn-nav-list nav nav-tabs" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">{{__("About")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">{{__("Education")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">{{__("Experience")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="skills-tab" data-bs-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="false">{{__("Skills")}}</a>
                    </li>
                </ul>

                <!-- Start Tab Content Wrapper  -->
                <div class="rn-nav-content tab-content" id="myTabContents">
                    <!-- Start Single Tab  -->
                    <div class="tab-pane show active fade single-tab-area" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <div class="personal-experience-inner mt--40">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="content">
                                        <h4 class="maintitle">{{__("About Me")}}</h4>
                                        <div class="about-content">
                                            <div class="description">
                                                {!! $about->getDescription() !!}
                                            </div>
                                            @if($about->getCvUrl())
                                            <div class="cv-download mt-4">
                                                <a href="{{ $about->getCvUrl() }}" class="rn-btn" download="{{ $about->cv_original_name }}">
                                                    <span>{{__("Download CV")}}</span>
                                                    <i data-feather="download"></i>
                                                </a>
                                                @if($about->getCvSize())
                                                <small class="text-muted d-block mt-2">{{__("File size")}}: {{ $about->getCvSize() }} MB</small>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Tab  -->

                    <!-- Start Single Tab  -->
                    <div class="tab-pane fade " id="education" role="tabpanel" aria-labelledby="education-tab">
                        <div class="personal-experience-inner mt--40">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content">
                                        <h4 class="maintitle">{{__("Education")}}</h4>
                                        <div class="row row--25 mt--30">
                                            @foreach($education as $index => $edu)
                                            <!-- Start Single Education -->
                                            <div class="col-lg-6 col-md-6 col-12 mt--30">
                                                <div class="education-card" style="background: #212428; border-radius: 10px; padding: 30px; box-shadow: 0 0 20px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                                    <div class="inner">
                                                        <div class="heading">
                                                            <div class="title">
                                                                <h4 style="color: #ffffff; margin-bottom: 5px; font-size: 18px; font-weight: 600;">{{ $edu->getTitle() }}</h4>
                                                                <span style="color: #c4cfde; font-size: 14px; font-weight: 500;">{{ $edu->getUniversityName() }}</span>
                                                            </div>
                                                            <div class="date-of-time">
                                                                <span style="color: #ff014f; font-size: 12px; font-weight: 600; background: rgba(255,1,79,0.1); padding: 5px 10px; border-radius: 5px;">{{ $edu->getFormattedStartDate() }} - {{ $edu->getFormattedEndDate() }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="description" style="color: #c4cfde; margin-top: 15px; line-height: 1.6; font-size: 14px;">{{ $edu->getDescription() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Education -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Tab  -->

                    <!-- Start Single Tab  -->
                    <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                        <div class="personal-experience-inner mt--40">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content">
                                        <h4 class="maintitle">{{__("Experience")}}</h4>
                                        <div class="row row--25 mt--30">
                                            @foreach($experiences as $index => $exp)
                                            <!-- Start Single Experience -->
                                            <div class="col-lg-6 col-md-6 col-12 mt--30">
                                                <div class="experience-card" style="background: #212428; border-radius: 10px; padding: 30px; box-shadow: 0 0 20px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                                    <div class="inner">
                                                        <div class="heading">
                                                            <div class="title">
                                                                <h4 style="color: #ffffff; margin-bottom: 5px; font-size: 18px; font-weight: 600;">{{ $exp->getTitle() }}</h4>
                                                                <span style="color: #c4cfde; font-size: 14px; font-weight: 500;">{{ $exp->getCompanyName() }}</span>
                                                            </div>
                                                            <div class="date-of-time">
                                                                <span style="color: #ff014f; font-size: 12px; font-weight: 600; background: rgba(255,1,79,0.1); padding: 5px 10px; border-radius: 5px;">{{ $exp->getFormattedStartDate() }} - {{ $exp->getFormattedEndDate() }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="description" style="color: #c4cfde; margin-top: 15px; line-height: 1.6; font-size: 14px;">{{ $exp->getDescription() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Experience -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Tab  -->

                    <!-- Start Single Tab  -->
                    <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                        <div class="personal-experience-inner mt--40">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content">
                                        <h4 class="maintitle">{{__("Skills")}}</h4>
                                        <div class="row row--25 mt--30">
                                            @foreach($skills as $index => $skill)
                                            <!-- Start Single Skill -->
                                            <div class="col-lg-6 col-md-6 col-12 mt--30">
                                                <div class="skill-card" style="background: #212428; border-radius: 10px; padding: 30px; box-shadow: 0 0 20px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                                    <div class="inner">
                                                        <div class="heading">
                                                            <div class="title">
                                                                <h4 style="color: #ffffff; margin-bottom: 15px; font-size: 18px; font-weight: 600;">{{ $skill->getTitle() }}</h4>
                                                            </div>
                                                            <div class="percent">
                                                                <span style="color: #ff014f; font-size: 14px; font-weight: 600;">{{ $skill->getFormattedPercent() }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrapper" style="margin-top: 15px;">
                                                            <div class="progress" style="height: 8px; background: #1d1f23; border-radius: 4px; overflow: hidden;">
                                                                <div class="progress-bar"
                                                                    style="background: linear-gradient(90deg, #ff014f 0%, #ff6b6b 100%); width: {{ $skill->percent }}%; height: 100%; border-radius: 4px; transition: width 1s ease-in-out;"
                                                                    role="progressbar"
                                                                    aria-valuenow="{{ $skill->percent }}"
                                                                    aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Skill -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Tab  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Resume Area -->

<!-- Start Certificates Area -->
<div class="rn-certificates-area rn-section-gap section-separator" id="certificates">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Certificates")}}</span>
                    <h2 class="title">{{__("My Certificates")}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($certificates->count() > 0)
                <div class="custom-certificates-slider">
                    <div class="slider-container">
                        @foreach($certificates as $index => $certificate)
                        <!-- Start Single Certificate -->
                        <div class="certificate-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                            <div class="certificate-card">
                                <div class="inner">
                                    <div class="certificate-image">
                                        <img src="{{ $certificate->getImageUrl() ?: 'assets/images/testimonial/final-home--1st.png' }}"
                                            alt="{{$certificate->getImageAltText()}}"
                                            class="certificate-modal-trigger"
                                            data-image="{{ $certificate->getImageUrl() ?: 'assets/images/testimonial/final-home--1st.png' }}"
                                            data-title="{{$certificate->getTitle()}}">
                                    </div>
                                    <div class="certificate-content">
                                        <h3 class="title">{{$certificate->getTitle()}}</h3>
                                        <span class="date">{{ $certificate->getFormattedIssueDate() }}</span>
                                        <p class="description">{{ $certificate->getDescription() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Certificate -->
                        @endforeach
                    </div>

                    <!-- Navigation -->
                    <button class="slider-nav prev-btn" id="prevBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="slider-nav next-btn" id="nextBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="slider-dots">
                        @foreach($certificates as $index => $certificate)
                        <button class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="text-center mt--50">
                    <p class="text-muted">{{__("No certificates available at the moment.")}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Certificates Area -->

<!-- Certificate Modal -->
<div id="certificateModal" class="certificate-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"></h3>
            <button style="width: 60px; height: 60px; cursor: pointer;" class="modal-close" id="closeModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <img class="modal-image" src="" alt="Certificate">
        </div>
    </div>
</div>

<!-- Start Portfolio Area -->
<div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("my projects title")}}</span>
                    <h2 class="title">{{__("my projects")}}</h2>
                </div>
            </div>
        </div>
        <div class="row mt--50 mt_md--40 mt_sm--40">
            @foreach($portfolios as $index => $portfolio)
            <!-- Start Single Portfolio -->
            <div class="col-lg-4 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 50) }}" data-aos-once="true">
                <div class="rn-service">
                    <div class="inner">
                        <div class="">
                            <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}"
                                alt="{{ $portfolio->getTitle() }}">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ $portfolio->project_link ?? '#' }}" target="_blank">{{ $portfolio->getTitle() }}</a>
                            </h4>
                            @if($portfolio->company_name)
                            <p class="company">
                                <a href="{{ $portfolio->company_website ?? '#' }}" target="_blank">
                                    {{ $portfolio->company_name }}
                                </a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Portfolio -->
            @endforeach
        </div>
    </div>
</div>
<!-- End Portfolio Area -->

<!-- Pricing Area -->
<div class="rn-pricing-area rn-section-gap section-separator" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Pricing")}}</span>
                    <h2 class="title">{{__("My Pricing Plans")}}</h2>
                </div>
            </div>
        </div>

        <div class="row mt--50 pricing-area" data-cards="{{ $pricingPlans->count() }}">
        @foreach($pricingPlans as $index => $plan)
        <div class="col-lg-4 col-md-6 col-sm-12 pricing-card-wrapper {{ $index >= 3 ? 'pricing-hidden' : '' }}" data-index="{{ $index }}">
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

                <div class="pricing-card-footer">
                    <a href="#contact" class="rn-btn d-block">
                        <span>{{__("Get Started")}}</span>
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($pricingPlans->count() > 3)
    <div class="row mt--30">
        <div class="col-lg-12 text-center">
            <button id="loadMorePricing" class="rn-btn">
                <span>{{__("Load More")}}</span>
                <i data-feather="arrow-down"></i>
            </button>
        </div>
    </div>
    @endif
</div>
</div>
<!-- End Pricing Area -->

<!-- Start News Area -->
<div class="rn-blog-area rn-section-gap section-separator" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="width: 100%;" class="section-title d-flex justify-content-between align-items-center flex-wrap">
                    <div class="title-column">
                        <span class="subtitle">{{__("Visit my blog and keep your feedback")}}</span>
                        <h2 class="title">{{__("My Blog")}}</h2>
                    </div>
                    <div class="view-all-btn ms-auto">
                        <a href="{{ localized_route('blogs.index') }}" class="rn-btn">
                            <span>{{__("View All")}}</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="row row--25 mt--30 mt_md--10 mt_sm--10" style="align-items: stretch;">

                @foreach($blogs as $index => $blog)
                <!-- Start Single blog -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 50) }}" data-aos-once="true" class="col-lg-6 col-xl-4 mt--30 col-md-6 col-sm-12 col-12 mt--30" style="display: flex;">
                    <div class="rn-blog">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="{{ localized_route('blog.show', [$blog->id, $blog->getSlug()]) }}" title="{{ $blog->getTitle() }}">
                                    <img src="{{ $blog->getCardImageUrl() ?: 'assets/images/blog/blog-01.jpg' }}" alt="{{ $blog->getCardImageAltText() }}">
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a href="{{ localized_route('blog.show', [$blog->id, $blog->getSlug()]) }}" title="{{ $blog->getTitle() }}">
                                        {{ Str::limit($blog->getTitle(), 60) }}
                                        <i class="feather-arrow-up-right"></i>
                                    </a>
                                </h4>
                                <div class="meta">
                                    <span><i class="feather-clock"></i> {{ $blog->getFormattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single blog -->
                @endforeach

            </div>
        </div>
    </div> <!-- End News Area -->

    <!-- Start Contact section -->
    @include('front.partials.contact-section')
</div> <!-- End Contuct section -->

<!-- Modal Portfolio Body area Start -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="portfolio-popup-thumbnail">
                            <div class="image">
                                <img class="w-100" src="assets/images/portfolio/portfolio-04.jpg" alt="slide">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="text-content">
                            <h3>
                                <span>Featured - Design</span> App Design Development.
                            </h3>
                            <p class="mb--30">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate distinctio assumenda explicabo veniam temporibus eligendi.</p>
                            <p>Consectetur adipisicing elit. Cupiditate distinctio assumenda. dolorum alias suscipit rerum maiores aliquam earum odit, nihil culpa quas iusto hic minus!</p>
                            <div class="button-group mt--20">
                                <a href="#" class="rn-btn thumbs-icon">
                                    <span>LIKE THIS</span>
                                    <i data-feather="thumbs-up"></i>
                                </a>
                                <a href="#" class="rn-btn">
                                    <span>VIEW PROJECT</span>
                                    <i data-feather="chevron-right"></i>
                                </a>
                            </div>

                        </div>
                        <!-- End of .text-content -->
                    </div>
                </div>
                <!-- End of .row Body-->
            </div>
        </div>
    </div>
</div> <!-- End Modal Portfolio area -->

<!-- Modal Blog Body area Start -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-news" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>

            <!-- End of .modal-header -->

            <div class="modal-body">
                <img src="assets/images/blog/blog-big-01.jpg" alt="news modal" class="img-fluid modal-feat-img">
                <div class="news-details">
                    <span class="date">2 May, 2021</span>
                    <h2 class="title">Digital Marketo to Their New Office.</h2>
                    <p>Nobis eleifend option congue nihil imperdiet doming id quod mazim placerat
                        facer
                        possim assum.
                        Typi non
                        habent claritatem insitam; est usus legentis in iis qui facit eorum
                        claritatem.
                        Investigationes
                        demonstraverunt
                        lectores legere me lius quod ii legunt saepius. Claritas est etiam processus
                        dynamicus, qui
                        sequitur
                        mutationem consuetudium lectorum.</p>
                    <h4>Nobis eleifend option conguenes.</h4>
                    <p>Mauris tempor, orci id pellentesque convallis, massa mi congue eros, sed
                        posuere
                        massa nunc quis
                        dui.
                        Integer ornare varius mi, in vehicula orci scelerisque sed. Fusce a massa
                        nisi.
                        Curabitur sit
                        amet
                        suscipit nisl. Sed eget nisl laoreet, suscipit enim nec, viverra eros. Nunc
                        imperdiet risus
                        leo,
                        in rutrum erat dignissim id.</p>
                    <p>Ut rhoncus vestibulum facilisis. Duis et lorem vitae ligula cursus venenatis.
                        Class aptent
                        taciti sociosqu
                        ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc vitae
                        nisi
                        tortor. Morbi
                        leo
                        nulla, posuere vel lectus a, egestas posuere lacus. Fusce eleifend hendrerit
                        bibendum. Morbi
                        nec
                        efficitur ex.</p>
                    <h4>Mauris tempor, orci id pellentesque.</h4>
                    <p>Nulla non ligula vel nisi blandit egestas vel eget leo. Praesent fringilla
                        dapibus dignissim.
                        Pellentesque
                        quis quam enim. Vestibulum ultrices, leo id suscipit efficitur, odio lorem
                        rhoncus dolor, a
                        facilisis
                        neque mi ut ex. Quisque tempor urna a nisi pretium, a pretium massa
                        tristique.
                        Nullam in
                        aliquam
                        diam. Maecenas at nibh gravida, ornare eros non, commodo ligula. Sed
                        efficitur
                        sollicitudin
                        auctor.
                        Quisque nec imperdiet purus, in ornare odio. Quisque odio felis, vestibulum
                        et.</p>
                </div>

                <!-- Comment Section Area Start -->
                <div class="comment-inner">
                    <h3 class="title mb--40 mt--50">Leave a Reply</h3>
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="rnform-group"><input type="text" placeholder="Name">
                                </div>
                                <div class="rnform-group"><input type="email" placeholder="Email">
                                </div>
                                <div class="rnform-group"><input type="text" placeholder="Website">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="rnform-group">
                                    <textarea placeholder="Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a class="rn-btn" href="#"><span>SUBMIT NOW</span></a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Comment Section End -->
            </div>
            <!-- End of .modal-body -->
        </div>
    </div>
</div> <!-- End Modal Blog area -->

<!-- Back to  top Start -->
<!-- Back to  top Start -->
<div class="backto-top">
    <div>
        <i data-feather="arrow-up"></i>
    </div>
</div>
<!-- Back to top end --> <!-- Back to top end -->



<!-- Start Modal Area  -->
<!-- Start Modal Area  -->
<div class="demo-modal-area">
    <div class="wrapper">
        <div class="close-icon">
            <button class="demo-close-btn"><span class="feather-x"></span></button>
        </div>
        <div class="rn-modal-inner">
            <div class="demo-top text-center">
                <h4 class="title">InBio</h4>
                <p class="subtitle">Its a personal portfolio template. You can built any personal website easily.</p>
            </div>
            <ul class="popuptab-area nav nav-tabs" id="popuptab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active demo-dark" id="demodark-tab" data-bs-toggle="tab" href="#demodark" role="tab" aria-controls="demodark" aria-selected="true">Dark Demo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link demo-light" id="demolight-tab" data-bs-toggle="tab" href="#demolight" role="tab" aria-controls="demolight" aria-selected="false">Light Demo</a>
                </li>
            </ul>
            <div class="tab-content" id="popuptabContent">
                <div class="tab-pane show active" id="demodark" role="tabpanel" aria-labelledby="demodark-tab">
                    <div class="content">
                        <div class="row">

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index.php">
                                                <img class="w-100" src="assets/images/demo/main-demo.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index.php">Main Demo</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-2">
                                        <div class="thumbnail">
                                            <a href="index-technician.php">
                                                <img class="w-100" src="assets/images/demo/index-technician.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-technician.php">Technician</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-2">
                                        <div class="thumbnail">
                                            <a href="index-model.php">
                                                <img class="w-100" src="assets/images/demo/home-model-v2.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-model.php">Model</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="home-consulting.php">
                                                <img class="w-100" src="assets/images/demo/home-consulting.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-consulting.php">Consulting</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="fashion-designer.php">
                                                <img class="w-100" src="assets/images/demo/fashion-designer.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="fashion-designer.php">Fashion Designer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index-developer.php">
                                                <img class="w-100" src="assets/images/demo/developer.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-developer.php">Developer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="instructor-fitness.php">
                                                <img class="w-100" src="assets/images/demo/instructor-fitness.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="instructor-fitness.php">Fitness Instructor</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->
                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="home-web-Developer.php">
                                                <img class="w-100" src="assets/images/demo/home-model.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-web-Developer.php">Web Developer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-designer.php">
                                                <img class="w-100" src="assets/images/demo/home-video.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-designer.php">Designer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-content-writer.php">
                                                <img class="w-100" src="assets/images/demo/text-rotet.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-content-writer.php">Content Writter</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-instructor.php">
                                                <img class="w-100" src="assets/images/demo/index-boxed.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-instructor.php">Instructor</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-freelancer.php">
                                                <img class="w-100" src="assets/images/demo/home-sticky.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-freelancer.php">Freelancer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-photographer.php">
                                                <img class="w-100" src="assets/images/demo/index-bg-image.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-photographer.php">Photographer</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index-politician.php">
                                                <img class="w-100" src="assets/images/demo/front-end.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-politician.php">Politician</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo coming-soon">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <img class="w-100" src="assets/images/demo/coming-soon.png" alt="Personal Portfolio">
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="#">Accountant</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                        </div>
                    </div>
                </div>


                <div class="tab-pane" id="demolight" role="tabpanel" aria-labelledby="demolight-tab">
                    <div class="content">
                        <div class="row">

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index-white-version.php">
                                                <img class="w-100" src="assets/images/demo/main-demo-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-white-version.php">Main Demo</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-2">
                                        <div class="thumbnail">
                                            <a href="index-technician-white-version.php">
                                                <img class="w-100" src="assets/images/demo/index-technician-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-technician-white-version.php">Technician</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-2">
                                        <div class="thumbnail">
                                            <a href="index-model-white-version.php">
                                                <img class="w-100" src="assets/images/demo/home-model-v2-white.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-model-white-version.php">Model</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="home-consulting-white-version.php">
                                                <img class="w-100" src="assets/images/demo/home-consulting-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-consulting-white-version.php">Consulting</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="fashion-designer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/fashion-designer-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="fashion-designer-white-version.php">Fashion Designer</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index-developer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/developer-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-developer-white-version.php">Developer</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->
                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="instructor-fitness-white-version.php">
                                                <img class="w-100" src="assets/images/demo/instructor-fitness-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="instructor-fitness-white-version.php">Fitness Instructor</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->
                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner badge-1">
                                        <div class="thumbnail">
                                            <a href="home-web-developer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/home-model-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-web-developer-white-version.php">Web Developer</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-designer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/home-video-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-designer-white-version.php">Designer</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-content-writer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/text-rotet-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-content-writer-white-version.php">Content
                                                    Writter</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-instructor-white-version.php">
                                                <img class="w-100" src="assets/images/demo/index-boxed-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-instructor-white-version.php">Instructor</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-freelancer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/home-sticky-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-freelancer-white-version.php">Freelancer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="home-photographer-white-version.php">
                                                <img class="w-100" src="assets/images/demo/index-bg-image-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="home-photographer-white-version.php">Photographer</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="index-politician-white-version.php">
                                                <img class="w-100" src="assets/images/demo/front-end-white-version.png" alt="Personal Portfolio">
                                                <span class="overlay-content">
                                                    <span class="overlay-text">View Demo <i class="feather-external-link"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="index-politician-white-version.php">Politician</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                            <!-- Start Single Content  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-demo coming-soon">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <img class="w-100" src="assets/images/demo/coming-soon.png" alt="Personal Portfolio">
                                            </a>
                                        </div>
                                        <div class="inner">
                                            <h3 class="title"><a href="#">Accountant</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content  -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Area  --> <!-- End Modal Area  -->

@endsection

@push('scripts')
<!-- Contact Form JavaScript -->
<script src="{{ asset('assets/js/contact-form.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/contact-form.css') }}">
<style>
    /* Portfolio Service Card Styles */
    .form-group {
        width: 100% !important;
    }

    .rn-service {
        background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
        border-radius: 15px;
        padding: 25px;
        box-shadow: var(--shadow-1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .rn-service:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .rn-service img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .rn-service:hover img {
        transform: scale(1.05);
    }

    .rn-service .content {
        text-align: center;
    }

    .rn-service .title {
        font-size: 18px;
        font-weight: 600;
        color: var(--color-heading);
        margin-bottom: 10px;
    }

    .rn-service .title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .rn-service .title a:hover {
        color: var(--color-primary);
    }

    .rn-service .company {
        font-size: 13px;
        color: var(--color-body);
        margin: 0;
        font-weight: 400;
    }

    .rn-service .company a {
        color: var(--color-body);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .rn-service .company a:hover {
        color: var(--color-primary);
    }

    /* Responsive */
    @media only screen and (max-width: 767px) {
        .rn-service {
            padding: 20px;
        }
    }

    @media only screen and (max-width: 575px) {
        .rn-service {
            padding: 15px;
        }
    }
</style>
<style>
    /* Blog Section Title Styles */
    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .section-title .title-column {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        text-align: left;
        flex: 1;
    }

    .title-column {
        flex-grow: 1;
    }

    .section-title .subtitle {
        font-size: 16px;
        color: var(--color-body);
        font-weight: 400;
        margin: 0;
    }

    .section-title .title {
        font-size: 48px;
        font-weight: 700;
        color: var(--color-heading);
        margin: 0;
    }

    .view-all-btn {
        margin-left: auto;
        margin-top: 10px;
    }


    .view-all-btn .rn-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--color-primary);
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .view-all-btn .rn-btn:hover {
        background: var(--color-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(var(--color-primary-rgb), 0.3);
    }

    .view-all-btn .rn-btn i {
        width: 16px;
        height: 16px;
        transition: transform 0.3s ease;
    }

    .view-all-btn .rn-btn:hover i {
        transform: translateX(3px);
    }

    /* Responsive */
    @media only screen and (max-width: 767px) {
        .section-title {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .section-title .title-column {
            align-items: center;
            flex: none;
        }

        .section-title .title {
            font-size: 36px;
        }

        .view-all-btn {
            margin-left: 0;
            margin-top: 20px;
        }

    }

    @media only screen and (max-width: 575px) {
        .section-title .title {
            font-size: 28px;
        }
    }

    /* Custom styling for form validation */
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Loading spinner for button */
    .fa-spinner {
        margin-right: 5px;
    }

    /* Portfolio Card Styles */
    .portfolio-card {
        background: linear-gradient(135deg, #212428 0%, #1d1f23 100%);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 4px solid #ff014f;
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
        margin: 10px;
        outline: 2px solid rgba(255, 1, 79, 0.3);
        outline-offset: 3px;
    }

    .portfolio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255, 1, 79, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .portfolio-card:hover::before {
        opacity: 1;
    }

    .portfolio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border-color: #ff014f;
        border-width: 5px;
        outline-color: rgba(255, 1, 79, 0.6);
        outline-width: 3px;
    }

    .portfolio-card .thumbnail {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .portfolio-card .thumbnail img {
        transition: transform 0.4s ease;
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .portfolio-card:hover .thumbnail img {
        transform: scale(1.1);
    }

    .portfolio-card .content {
        padding: 0;
        position: relative;
        z-index: 2;
    }

    .portfolio-card .portfolio-info {
        text-align: center;
    }

    .portfolio-card .title {
        font-size: 14px;
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .portfolio-card .title a {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .portfolio-card .title a:hover {
        color: var(--color-primary);
    }

    .portfolio-card .company {
        font-size: 13px;
        color: #c4cfde;
        margin: 0;
        font-weight: 400;
    }

    .portfolio-card .company a {
        color: #c4cfde;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .portfolio-card .company a:hover {
        color: var(--color-primary);
    }

    /* Additional Card Styling */
    .portfolio-card {
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.3),
            0 0 0 4px #ff014f,
            0 0 0 8px rgba(255, 1, 79, 0.2);
    }

    .portfolio-card:hover {
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 0 6px #ff014f,
            0 0 0 12px rgba(255, 1, 79, 0.3);
    }

    /* Ensure cards are properly spaced */
    .col-lg-4.col-md-6.col-12.mt--30 {
        margin-bottom: 30px;
    }

    /* Card background with pattern */
    .portfolio-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            linear-gradient(45deg, transparent 30%, rgba(255, 1, 79, 0.05) 50%, transparent 70%);
        pointer-events: none;
        border-radius: 20px;
    }

    /* SweetAlert customization */
    .swal2-popup {
        border-radius: 15px;
    }

    .swal2-title {
        color: #333;
    }

    .swal2-confirm {
        border-radius: 8px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
    }

    /* Contact form styles are now in external CSS file */

    /* View All Button Styles */
    .view-all-btn .rn-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        background: linear-gradient(45deg, #ff014f, #ff6b9d);
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(255, 1, 79, 0.3);
    }

    .view-all-btn .rn-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255, 1, 79, 0.4);
        color: white;
        border-radius: 25px;
    }

    .view-all-btn .rn-btn i {
        width: 16px;
        height: 16px;
        transition: transform 0.3s ease;
    }

    .view-all-btn .rn-btn:hover i {
        transform: translateX(3px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hiddenCards = document.querySelectorAll('.pricing-hidden');
    const loadMoreBtn = document.getElementById('loadMorePricing');
    
    console.log('Hidden cards found:', hiddenCards.length);
    console.log('Load More button found:', loadMoreBtn);
    
    // Load More functionality
    if (loadMoreBtn && hiddenCards.length > 0) {
        loadMoreBtn.addEventListener('click', function() {
            console.log('Load More clicked!');
            
            // Show all hidden cards with animation
            hiddenCards.forEach((card, index) => {
                setTimeout(() => {
                    // Remove the hidden class and set display to block
                    card.classList.remove('pricing-hidden');
                    card.style.display = 'block';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    
                    // Trigger animation after a small delay
                    setTimeout(() => {
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                    
                    console.log('Showing card:', index);
                }, index * 100);
            });
            
            // Hide the load more button
            setTimeout(() => {
                loadMoreBtn.style.display = 'none';
                console.log('Load More button hidden');
            }, hiddenCards.length * 100 + 500);
        });
    } else if (loadMoreBtn) {
        // If no hidden cards, hide the button
        loadMoreBtn.style.display = 'none';
        console.log('No hidden cards, hiding button');
    }
});
</script>
@endpush