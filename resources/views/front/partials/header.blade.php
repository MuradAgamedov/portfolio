<!-- Start Header -->
<header class="rn-header haeder-default inbio-default-header">
    <div class="header-wrapper rn-popup-mobile-menu m--0 row align-items-center">
        <!-- Start Header Left -->
        <div class="col-lg-2 col-6">
            <div class="header-left">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        @php
                            $headerLogo = \App\Models\SiteSetting::getByKey('header_logo');
                            $headerLogoAlt = \App\Models\SiteSetting::getByKey('header_logo_alt');
                        @endphp
                        @if($headerLogo)
                            <img src="{{ asset('storage/' . $headerLogo) }}" alt="{{ $headerLogoAlt ?: 'Logo' }}">
                        @else
                            <img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo">
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <!-- End Header Left -->
        <!-- Start Header Center -->
        <div class="col-lg-10 col-6">
            <div class="header-center">
                <nav class="mainmenu-nav d-none d-xl-block">
                    <ul class="primary-menu">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">{{__("About")}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#resume">Resume</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}">{{__("Blog")}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </nav>
                <!-- Start Header Right  -->
                <div class="header-right">
                    <a class="rn-btn" href="#contact"><span>{{__("CONTACT ME")}}</span></a>

                    <div class="hamberger-menu d-block d-xl-none">
                        <i id="menuBtn" class="feather-menu humberger-menu"></i>
                    </div>

                    <div class="close-menu d-block">
                        <span class="closeTrigger">
                            <i data-feather="x"></i>
                        </span>
                    </div>
                </div>
                <!-- End Header Right  -->

            </div>
        </div>
        <!-- End Header Center -->
    </div>
</header>
<!-- End Header Area -->

<!-- Start Popup Mobile Menu  -->
<div class="popup-mobile-menu">
    <div class="inner">
        <div class="menu-top">
            <div class="menu-header">
                <a class="logo" href="{{ route('home') }}">
                    @php
                        $headerLogo = \App\Models\SiteSetting::getByKey('header_logo');
                        $headerLogoAlt = \App\Models\SiteSetting::getByKey('header_logo_alt');
                    @endphp
                    @if($headerLogo)
                        <img src="{{ asset('storage/' . $headerLogo) }}" alt="{{ $headerLogoAlt ?: 'Personal Portfolio' }}">
                    @else
                        <img src="{{ asset('assets/images/logo/logos-circle.png') }}" alt="Personal Portfolio">
                    @endif
                </a>
                <div class="close-button">
                    <button class="close-menu-activation close"><i data-feather="x"></i></button>
                </div>
            </div>
            <p class="discription">Professional portfolio showcasing my skills and experience in web development and design.</p>
        </div>
        <div class="content">
            <ul class="primary-menu">
                <li><a class="nav-link" href="#home">Home</a></li>
                <li><a class="nav-link" href="#experience">Experience</a></li>
                                        <li><a class="nav-link" href="#about">{{__("About")}}</a></li>
                <li><a class="nav-link" href="#resume">Resume</a></li>
                <li><a class="nav-link" href="#portfolio">Portfolio</a></li>
                <li><a class="nav-link" href="{{ route('blogs') }}">{{__("Blog")}}</a></li>
                <li><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <!-- social sharea area -->
            <div class="social-share-style-1 mt--40">
                <span class="title">find with me</span>
                <ul class="social-share d-flex liststyle">
                    <li class="facebook"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg></a>
                    </li>
                    <li class="instagram"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg></a>
                    </li>
                    <li class="linkedin"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg></a>
                    </li>
                </ul>
            </div>
            <!-- end -->
        </div>
    </div>
</div>
<!-- End Popup Mobile Menu  --> 