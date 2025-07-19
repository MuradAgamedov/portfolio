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
                <nav class="mainmenu-nav">
                    <ul class="primary-menu">
                        <li class="nav-item"><a class="nav-link" href="#home">{{__("LET'S KNOW ME")}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#features">{{__("Services")}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#resume">{{__("Resume")}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contacts">{{__("Contacts")}}</a></li>
                    </ul>
                </nav>
                <!-- Start Header Right  -->
                <div class="header-right">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ strtoupper(app()->getLocale()) }}</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                @foreach(\App\Models\Language::where('status', 1)->orderBy('order')->get() as $language)
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() == $language->lang_code ? 'active' : '' }}" 
                                           href="{{ route('language.switch', $language->lang_code) }}">
                                            <span class="flag-icon flag-icon-{{ $language->lang_code }}"></span>
                                            {{ strtoupper($language->lang_code) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- BUY NOW Button -->
                    <a class="rn-btn buy-now-btn" href="#"><span>{{__("BUY NOW")}}</span></a>

                    <div class="mobile-menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <!-- End Header Right  -->

            </div>
        </div>
        <!-- End Header Center -->
    </div>
</header>
<!-- End Header Area -->

<!-- Custom Mobile Menu -->
<div class="custom-mobile-menu">
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu-content">
        <div class="mobile-menu-header">
            <div class="mobile-logo">
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
            <button class="mobile-menu-close">
                <span></span>
                <span></span>
            </button>
        </div>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu-list">
                <li><a href="#home">{{__("LET'S KNOW ME")}}</a></li>
                <li><a href="#features">{{__("SERVICES")}}</a></li>
                <li><a href="#resume">{{__("RESUME")}}</a></li>
                <li><a href="#contacts">{{__("CONTACTS")}}</a></li>
            </ul>
        </nav>
        
        <div class="mobile-social">
            <h4>{{__("find with me")}}</h4>
            <div class="social-links">
                @foreach($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" class="social-link">
                        <i data-feather="{{ $social->platform }}"></i>
                        <span>{{ ucfirst($social->platform) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div> 