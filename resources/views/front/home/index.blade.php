@extends('front.layouts.master')

@section('title', 'Murad Portfolio - Home')

@section('content')
    <!-- Start Slider Area -->
    <div id="home" class="rn-slider-area">
        <div class="slide slider-style-1">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7 mt_md--50 mt_sm--50 mt_lg--30">
                        <div class="content">
                            <div class="inner">
                                <span class="subtitle">{{ $heroData->subtitle ?? 'Welcome to my world' }}</span>
                                <h1 class="title">Hi, I'm <span>{{ $heroData->name ?? 'Murad' }}</span><br>
                                    <span class="header-caption" id="page-top">
                                        <!-- type headline start-->
                                        <span class="cd-headline clip is-full-width">
                                            <span>{{ $heroData->label ?? 'a ' }}</span>
                                            <!-- ROTATING TEXT -->
                                            <span class="cd-words-wrapper">
                                                @foreach($heroProfessions as $profession)
                                                    <b class="{{ $loop->first ? 'is-visible' : 'is-hidden' }}">{{ $profession->title }}.</b>
                                                @endforeach
                                            </span>
                                        </span>
                                        <!-- type headline end -->
                                    </span>
                                </h1>

                                <div>
                                    <p class="description">{{ $heroData->description ?? 'I use animation as a third dimension by which to simplify experiences and guiding through each and every interaction. I\'m not adding motion just to spruce things up, but doing it in ways that.' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">
                                    <div class="social-share-inner-left">
                                        <span class="title">find with me</span>
                                        <ul class="social-share d-flex liststyle">
                                            <li class="facebook"><a href="#"><i data-feather="facebook"></i></a></li>
                                            <li class="instagram"><a href="#"><i data-feather="instagram"></i></a></li>
                                            <li class="linkedin"><a href="#"><i data-feather="linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30">
                                    <div class="skill-share-inner">
                                        <span class="title">best skill on</span>
                                        <ul class="skill-share d-flex liststyle">
                                            <li><img src="{{ asset('assets/images/icons/icons-01.png') }}" alt="Icons Images"></li>
                                            <li><img src="{{ asset('assets/images/icons/icons-02.png') }}" alt="Icons Images"></li>
                                            <li><img src="{{ asset('assets/images/icons/icons-03.png') }}" alt="Icons Images"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 order-lg-2 col-lg-5">
                        <div class="thumbnail">
                            <div class="inner">
                                <img src="{{ asset('assets/images/slider/banner-01.png') }}" alt="Personal Portfolio Images">
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
                        <span class="subtitle">Features</span>
                        <h2 class="title">What I Do</h2>
                    </div>
                </div>
            </div>
            <div class="row row--25 mt_md--10 mt_sm--10">

                @foreach($services as $service)
                <!-- Start Single Service -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ $loop->index * 200 + 100 }}" data-aos-once="true" class="col-lg-6 col-xl-4 col-md-6 col-sm-12 col-12 mt--50 mt_md--30 mt_sm--30">
                    <div class="rn-service">
                        <div class="inner">
                            <div class="icon">
                                <i data-feather="{{ $service->icon ?? 'code' }}"></i>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="#">{{ $service->title }}</a></h4>
                                <p class="description">{{ $service->description }}</p>
                                <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                            </div>
                        </div>
                        <a class="over-link" href="#"></a>
                    </div>
                </div>
                <!-- End Single Service -->
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Service Area  -->

    <!-- Start Portfolio Area -->
    <div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span class="subtitle">Visit my portfolio and keep your feedback</span>
                        <h2 class="title">My Portfolio</h2>
                    </div>
                </div>
            </div>

            <div class="row row--25 mt--10 mt_md--10 mt_sm--10">
                @foreach($portfolios as $portfolio)
                <!-- Start Single Portfolio -->
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 + 100 }}" data-aos-once="true" class="col-lg-6 col-xl-4 col-md-6 col-12 mt--50 mt_md--30 mt_sm--30">
                    <div class="rn-portfolio" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                                </a>
                            </div>
                            <div class="content">
                                <div class="category-info">
                                    <div class="category-list">
                                        <a href="javascript:void(0)">{{ $portfolio->category->name ?? 'Uncategorized' }}</a>
                                    </div>
                                    <div class="meta">
                                        <span><a href="javascript:void(0)"><i class="feather-heart"></i></a> {{ $portfolio->likes ?? 0 }}</span>
                                    </div>
                                </div>
                                <h4 class="title"><a href="javascript:void(0)">{{ $portfolio->title }} <i class="feather-arrow-up-right"></i></a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Portfolio -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- End portfolio Area -->

    <!-- Start Resume Area -->
    <div class="rn-resume-area rn-section-gap section-separator" id="resume">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span class="subtitle">7+ Years of Experience</span>
                        <h2 class="title">My Resume</h2>
                    </div>
                </div>
            </div>
            <div class="row mt--45">
                <div class="col-lg-12">
                    <ul class="rn-nav-list nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="education-tab" data-bs-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="true">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="professional-tab" data-bs-toggle="tab" href="#professional" role="tab" aria-controls="professional" aria-selected="false">Professional Skills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
                        </li>
                    </ul>

                    <!-- Start Tab Content Wrapper  -->
                    <div class="rn-nav-content tab-content" id="myTabContents">
                        <!-- Start Single Tab  -->
                        <div class="tab-pane show active fade single-tab-area" id="education" role="tabpanel" aria-labelledby="education-tab">
                            <div class="personal-experience-inner mt--40">
                                <div class="row">
                                    <!-- Start Skill List Area  -->
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="content">
                                            <span class="subtitle">2007 - 2010</span>
                                            <h4 class="maintitle">Education Quality</h4>
                                            <div class="experience-list">
                                                <!-- Start Single List  -->
                                                <div class="resume-single-list">
                                                    <div class="inner">
                                                        <div class="heading">
                                                            <div class="title">
                                                                <h4>Bachelor of Computer Science</h4>
                                                                <span>University of Technology (2007 - 2011)</span>
                                                            </div>
                                                            <div class="date-of-time">
                                                                <span>4.30/5</span>
                                                            </div>
                                                        </div>
                                                        <p class="description">The education should be very interactive. Ut tincidunt est ac dolor aliquam sodales. Phasellus sed mauris hendrerit, laoreet sem in, lobortis mauris hendrerit ante.</p>
                                                    </div>
                                                </div>
                                                <!-- End Single List  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Skill List Area  -->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Tab  -->

                        <!-- Start Single Tab  -->
                        <div class="tab-pane fade" id="professional" role="tabpanel" aria-labelledby="professional-tab">
                            <div class="personal-experience-inner mt--40">
                                <div class="row row--40">
                                    <!-- Start Single Progressbar  -->
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="progress-wrapper">
                                            <div class="content">
                                                <span class="subtitle">Features</span>
                                                <h4 class="maintitle">Design Skill</h4>
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <h6 class="heading heading-h6">PHOTOSHOP</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="percent-label">100%</span></div>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->

                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <h6 class="heading heading-h6">FIGMA</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.6s" data-wow-delay=".4s" role="progressbar" style="width: 95%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="percent-label">95%</span></div>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Progressbar  -->

                                    <!-- Start Single Progressbar  -->
                                    <div class="col-lg-6 col-md-6 col-12 mt_sm--60">
                                        <div class="progress-wrapper">
                                            <div class="content">
                                                <span class="subtitle">Features</span>
                                                <h4 class="maintitle">Development Skill</h4>
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <h6 class="heading heading-h6">HTML</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="percent-label">85%</span></div>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->

                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <h6 class="heading heading-h6">CSS</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.6s" data-wow-delay=".4s" role="progressbar" style="width: 80%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="percent-label">80%</span></div>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->

                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <h6 class="heading heading-h6">JAVASCRIPT</h6>
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.7s" data-wow-delay=".5s" role="progressbar" style="width: 90%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="percent-label">90%</span></div>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Progressbar  -->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Tab  -->

                        <!-- Start Single Tab  -->
                        <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                            <div class="personal-experience-inner mt--40">
                                <div class="row">
                                    <!-- Start Skill List Area  -->
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="content">
                                            <span class="subtitle">2015 - 2024</span>
                                            <h4 class="maintitle">Job Experience</h4>
                                            <div class="experience-list">
                                                <!-- Start Single List  -->
                                                <div class="resume-single-list">
                                                    <div class="inner">
                                                        <div class="heading">
                                                            <div class="title">
                                                                <h4>Senior Web Developer</h4>
                                                                <span>Tech Company (2020 - 2024)</span>
                                                            </div>
                                                            <div class="date-of-time">
                                                                <span>Full Time</span>
                                                            </div>
                                                        </div>
                                                        <p class="description">Led development of multiple web applications using modern technologies. Managed team of junior developers and implemented best practices.</p>
                                                    </div>
                                                </div>
                                                <!-- End Single List  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Skill List Area  -->
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

    <!-- Start Contact Area -->
    <div class="rn-contact-area rn-section-gap section-separator" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span class="subtitle">Contact</span>
                        <h2 class="title">Contact With Me</h2>
                    </div>
                </div>
            </div>

            <div class="row mt--50 mt_md--40 mt_sm--40 mt-contact-sm">
                <div class="col-lg-5">
                    <div class="contact-about-area">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/images/contact/contact1.png') }}" alt="contact-img">
                        </div>
                        <div class="title-area">
                            <h4 class="title">Murad</h4>
                            <span>Full Stack Developer</span>
                        </div>
                        <div class="description">
                            <p>I am available for freelance work. Connect with me via phone or email.</p>
                            <span class="phone">Phone: <a href="tel:+1234567890">+1234567890</a></span>
                            <span class="mail">Email: <a href="mailto:contact@example.com">contact@example.com</a></span>
                        </div>
                        <div class="social-area">
                            <div class="name">FIND WITH ME</div>
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
                            <form class="rnt-contact-form rwt-dynamic-form row" id="contact-form" method="POST" action="{{ route('contact.send') }}">
                                @csrf
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="contact-name">Your Name</label>
                                        <input class="form-control form-control-lg" name="name" id="contact-name" type="text" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="contact-phone">Phone Number</label>
                                        <input class="form-control" name="phone" id="contact-phone" type="text" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contact-email">Email</label>
                                        <input class="form-control form-control-sm" id="contact-email" name="email" type="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input class="form-control form-control-sm" id="subject" name="subject" type="text" value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contact-message">Your Message</label>
                                        <textarea name="message" id="contact-message" cols="30" rows="10" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button name="submit" type="submit" id="submit" class="rn-btn">
                                        <span>SEND MESSAGE</span>
                                        <i data-feather="arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->
@endsection