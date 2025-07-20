@extends('front.layouts.master')

@section('title', 'Home')

@section('content')
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
                <div class="section-title text-center">
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
                                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button class="slider-nav next-btn" id="nextBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <img class="modal-image" src="" alt="Certificate">
        </div>
    </div>
</div>

<!-- Start Client Area -->
<div class="rn-client-area rn-section-gap section-separator" id="clients">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span class="subtitle">{{__("my projects")}}</span>
                    <h2 class="title">{{__("my projects")}}</h2>
                </div>
            </div>
        </div>
        <div class="row row--25 mt--50 mt_md--40 mt_sm--40">
            <div class="col-lg-4">
                <div class="d-flex flex-wrap align-content-start h-100">
                    <div class="position-sticky clients-wrapper sticky-top rbt-sticky-top-adjust">
                        <ul class="nav tab-navigation-button flex-column nav-pills me-3" id="v-pills-tab" role="tablist">
                    @foreach($portfolioCategories as $index => $category)
                            <li class="nav-item">
                            <a class="nav-link @if($index === 0) active @endif"
                               id="v-pills-tab-{{ $category->id }}"
                               data-bs-toggle="tab"
                               href="#v-pills-content-{{ $category->id }}"
                               role="tab"
                               aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $category->getTitle() }}
                            </a>
                            </li>
                    @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="tab-area">
                    <div class="d-flex align-items-start">
                <div class="tab-content w-100" id="v-pills-tabContent">
                    @foreach($portfolioCategories as $index => $category)
                        <div class="tab-pane fade @if($index === 0) show active @endif"
                             id="v-pills-content-{{ $category->id }}"
                             role="tabpanel"
                             aria-labelledby="v-pills-tab-{{ $category->id }}">

                            <div class="client-card d-flex flex-wrap gap-4">
                                @foreach($portfolios->where('category_id', $category->id) as $portfolio)
                                    <div class="main-content" style="width: calc(50% - 1rem);">
                                        <div class="inner text-center">
                                            <div class="thumbnail" style="width: 100%;padding:20px; height: 240px; overflow: hidden;">
                                                                                         <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}"
                                                         alt="{{ $portfolio->getTitle() }}"
                                                         style="width: 100%; height: 100%; object-fit: cover;">
                                               
                                            </div>
                                            <div class="seperator my-2"></div>
                                            <div class="client-name">
                                                <a href="{{ $portfolio->company_website ?? '#' }}" target="_blank">
                                                    {{ $portfolio->company_name }}
                                                    </a>
                                                    <span>-</span>
                                                                                                         <a href="{{ $portfolio->project_link ?? '#' }}" target="_blank">
                                                     {{ $portfolio->getTitle() }}
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                            </div>

                                            </div>
                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                            </div>
                                            </div>

    </div>
</div>
<!-- End client section -->

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
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="pricing-card {{ $index == 1 ? 'featured' : '' }}">
                    <div class="pricing-card-header">
                        <div class="pricing-badge">{{ $index == 1 ? 'Popular' : ($index == 0 ? 'Basic' : ($index == 2 ? 'Premium' : 'Enterprise')) }}</div>
                        <div class="pricing-price">
                            {!! $plan->getTranslation('price', app()->getLocale()) !!}
                                    </div>
                        <h3 class="pricing-title">{{ $plan->getTranslation('title', app()->getLocale()) }}</h3>
                        </div>

                    <div class="pricing-card-body">
                        <ul class="pricing-features">
                            @foreach($plan->activeFeatures as $feature)
                            <li><i data-feather="check"></i> {{ $feature->getTranslation('title', app()->getLocale()) }}</li>
                            @endforeach
                        </ul>
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
                            </div>
                        </div>
<!-- End Pricing Area -->

<!-- Start News Area -->
<div class="rn-blog-area rn-section-gap section-separator" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="section-title d-flex justify-content-between align-items-center flex-wrap">
    <div class="title-column">
        <span class="subtitle">{{__("Visit my blog and keep your feedback")}}</span>
        <h2 class="title">{{__("My Blog")}}</h2>
    </div>
    <div class="view-all-btn ms-auto">
        <a href="{{ route('blogs.index') }}" class="rn-btn">
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
                            <a href="{{ route('blog.show', $blog->getSlug()) }}">
                                <img src="{{ $blog->getCardImageUrl() ?: 'assets/images/blog/blog-01.jpg' }}" alt="{{ $blog->getCardImageAltText() }}">
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ route('blog.show', $blog->getTranslation('slug', app()->getLocale())) }}">
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
                        <span class="phone">{{__("Phone")}}: <a href="tel:{{ $phone ?: '01941043264' }}">{{ $phone ?: '+01234567890' }}</a></span>
                        <span class="mail">{{__("Email")}}: <a href="mailto:{{ $email ?: 'admin@example.com' }}">{{ $email ?: 'admin@example.com' }}</a></span>
                    </div>
                    <div class="social-area">
                        <div class="name">{{__("FIND WITH ME")}}</div>
                        <div class="social-icone">
                            <a href="#"><i data-feather="facebook"></i></a>
                            <a href="#"><i data-feather="linkedin"></i></a>
                            <a href="#"><i data-feather="instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-aos-delay="600" class="col-lg-7 contact-input">
                <div class="contact-form-wrapper">
                    <div class="introduce">

                        <form class="rnt-contact-form rwt-dynamic-form row" id="contact-form" method="POST">
                            @csrf

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact-name">{{__("Your Name")}}</label>
                                    <input class="form-control form-control-lg" name="contact-name" id="contact-name" type="text">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact-phone">{{__("Phone Number")}}</label>
                                    <input class="form-control" name="contact-phone" id="contact-phone" type="text">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="contact-email">{{__("Email")}}</label>
                                    <input class="form-control form-control-sm" id="contact-email" name="contact-email" type="email">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="subject">{{__("Subject")}}</label>
                                    <input class="form-control form-control-sm" id="subject" name="subject" type="text">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="contact-message">{{__("Your Message")}}</label>
                                    <textarea name="contact-message" id="contact-message" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="g-recaptcha mb-3" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                <button name="submit" type="submit" id="submit" class="rn-btn">
                                    <span>{{__("SEND MESSAGE")}}</span>
                                    <i data-feather="arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<!-- Contact Form AJAX -->
<script>
$(document).ready(function() {
    // Contact form submission
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        var formData = new FormData(this);
        
        // Show loading state
        var submitBtn = $('#submit');
        var originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> {{__("Sending...")}}');
        submitBtn.prop('disabled', true);
        
        // AJAX request
        $.ajax({
            url: '{{ route("contact") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: '{{__("Success!")}}',
                    text: '{{__("Thank you for your message! We will get back to you soon.")}}',
                    confirmButtonText: '{{__("OK")}}',
                    confirmButtonColor: '#667eea'
                });
                
                // Reset form
                $('#contact-form')[0].reset();
                
                // Reset button
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            },
            error: function(xhr) {
                var errorMessage = '{{__("An error occurred. Please try again.")}}';
                
                // Check if there are validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorList = '';
                    
                    for (var field in errors) {
                        errorList += errors[field][0] + '\n';
                    }
                    
                    errorMessage = errorList;
                }
                
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: '{{__("Error!")}}',
                    text: errorMessage,
                    confirmButtonText: '{{__("OK")}}',
                    confirmButtonColor: '#dc3545'
                });
                
                // Reset button
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        });
    });
    
    // Form validation on input
    $('#contact-form input, #contact-form textarea').on('blur', function() {
        var field = $(this);
        var value = field.val().trim();
        var fieldName = field.attr('name');
        
        // Remove existing error styling
        field.removeClass('is-invalid');
        field.siblings('.invalid-feedback').remove();
        
        // Validate required fields
        if (fieldName === 'contact-name' && value === '') {
            showFieldError(field, '{{__("Name is required")}}');
        } else if (fieldName === 'contact-email' && value === '') {
            showFieldError(field, '{{__("Email is required")}}');
        } else if (fieldName === 'contact-email' && value !== '' && !isValidEmail(value)) {
            showFieldError(field, '{{__("Please enter a valid email address")}}');
        } else if (fieldName === 'subject' && value === '') {
            showFieldError(field, '{{__("Subject is required")}}');
        } else if (fieldName === 'contact-message' && value === '') {
            showFieldError(field, '{{__("Message is required")}}');
        }
    });
    
    function showFieldError(field, message) {
        field.addClass('is-invalid');
        field.after('<div class="invalid-feedback">' + message + '</div>');
    }
    
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Clear validation errors on input
    $('#contact-form input, #contact-form textarea').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').remove();
    });
});
</script>
@endpush

@push('styles')
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
</style>
@endpush
