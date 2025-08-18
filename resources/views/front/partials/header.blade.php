<!-- Start Header -->
<header class="rn-header haeder-default inbio-default-header">
    <div class="header-wrapper rn-popup-mobile-menu m--0 row align-items-center">
        <!-- Start Header Left -->
        <div class="col-lg-2 col-6">
            <div class="header-left">
                <div class="logo">
                    <a href="{{ localized_route('home') }}" title="{{__("Sayt hazırlanması")}}">
                        @php
                            $headerLogo = \App\Models\SiteSetting::getByKey('header_logo');
                            $headerLogoAlt = \App\Models\SiteSetting::getByKey('header_logo_alt');
                        @endphp
                        @if($headerLogo)
                            <img src="{{ asset('storage/' . $headerLogo) }}" alt="{{ $headerLogoAlt ?: 'Logo' }}">
                        @else
                            <img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo">
                        @endif
                        <span class="logo-text">Murad Agamedov</span>
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
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ localized_route('home') }}" title="{{__("Go to homepage")}}">{{__("HOME")}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}" href="{{ localized_route('services.index') }}" title="{{__("View my services and what I offer")}}">{{__("Services")}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('pricing.index') ? 'active' : '' }}" href="{{ localized_route('pricing.index') }}" title="{{__("View all pricing plans")}}">{{__("PRICING")}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('portfolios.index') ? 'active' : '' }}" href="{{ localized_route('portfolios.index') }}" title="{{__("View my portfolio projects")}}">{{__("PORTFOLIO")}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" href="{{ localized_route('blogs.index') }}" title="{{__("Read my blog posts")}}">{{__("BLOG")}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ localized_route('contact') }}" title="{{__("Get in touch with me")}}">{{__("CONTACT")}}</a></li>
                    </ul>
                </nav>
                <!-- Start Header Right  -->
                <div class="header-right">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="{{__("Change language")}}">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ strtoupper(app()->getLocale()) }}</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                @foreach(get_available_languages() as $language)
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() == $language->lang_code ? 'active' : '' }}" 
                                           href="{{ switch_language_url($language->lang_code) }}">
                                            <span class="flag-icon flag-icon-{{ $language->lang_code }}"></span>
                                            {{ strtoupper($language->lang_code) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- BUY NOW Button -->
                    <a class="rn-btn buy-now-btn" href="{{ localized_route('contact') }}" title="{{__("Contact me now")}}"><span>{{__("CONTACT NOW")}}</span></a>

                    <div class="mobile-menu-toggle" title="{{__("Open mobile menu")}}">
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
                <a href="{{ localized_route('home') }}" title="{{__("Go to homepage")}}">
                    @php
                        $headerLogo = \App\Models\SiteSetting::getByKey('header_logo');
                        $headerLogoAlt = \App\Models\SiteSetting::getByKey('header_logo_alt');
                    @endphp
                    @if($headerLogo)
                        <img src="{{ asset('storage/' . $headerLogo) }}" alt="{{ $headerLogoAlt ?: 'Logo' }}">
                    @else
                        <img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo">
                    @endif
                    <span class="mobile-logo-text">Murad Agamedov</span>
                </a>
            </div>
            <button class="mobile-menu-close" title="{{__("Close mobile menu")}}">
                <span></span>
                <span></span>
            </button>
        </div>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu-list">
                <li><a href="{{ localized_route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}" title="{{__("Go to homepage")}}">{{__("HOME")}}</a></li>
                <li><a href="{{ localized_route('services.index') }}" class="{{ request()->routeIs('services.index') ? 'active' : '' }}" title="{{__("View my services and what I offer")}}">{{__("SERVICES")}}</a></li>
                <li><a href="{{ localized_route('pricing.index') }}" class="{{ request()->routeIs('pricing.index') ? 'active' : '' }}" title="{{__("View all pricing plans")}}">{{__("PRICING")}}</a></li>
                <li><a href="{{ localized_route('portfolios.index') }}" class="{{ request()->routeIs('portfolios.index') ? 'active' : '' }}" title="{{__("View my portfolio projects")}}">{{__("PORTFOLIO")}}</a></li>
                <li><a href="{{ localized_route('blogs.index') }}" class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}" title="{{__("Read my blog posts")}}">{{__("BLOG")}}</a></li>
                <li><a href="{{ localized_route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}" title="{{__("Get in touch with me")}}">{{__("CONTACT")}}</a></li>
            </ul>
        </nav>
        
        <!-- Mobile Language Switcher -->
        <div class="mobile-language-switcher">
            <h4>{{__("Language")}}</h4>
            <div class="mobile-lang-options">
                @foreach(get_available_languages() as $language)
                    <a href="{{ switch_language_url($language->lang_code) }}" 
                       class="mobile-lang-option {{ app()->getLocale() == $language->lang_code ? 'active' : '' }}">
                        <span class="flag-icon flag-icon-{{ $language->lang_code }}"></span>
                        <span>{{ strtoupper($language->lang_code) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        
        <div class="mobile-social">
            <h4>{{__("find with me")}}</h4>
            <div class="social-links">
                @foreach($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" class="social-link" title="{{__("Visit my")}} {{ ucfirst($social->platform) }} {{__("profile")}}">
                        <i data-feather="{{ $social->platform }}"></i>
                        <span>{{ ucfirst($social->platform) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div> 