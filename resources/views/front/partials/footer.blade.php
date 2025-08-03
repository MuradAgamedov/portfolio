<!-- Start Footer Area -->
<div class="rn-footer-area rn-section-gap section-separator">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-area text-center">

                    <div class="logo" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                        <a href="{{ localized_route('home') }}" style="display: inline-block;">
                            @php
                                $footerLogo = \App\Models\SiteSetting::getByKey('footer_logo');
                                $footerLogoAlt = \App\Models\SiteSetting::getByKey('footer_logo_alt');
                            @endphp
                            @if($footerLogo)
                                <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ $footerLogoAlt ?: 'logo' }}" style="max-width: 150px; height: auto;">
                            @else
                                <img src="{{ asset('assets/images/logo/logo-vertical.png') }}" alt="logo" style="max-width: 150px; height: auto;">
                            @endif
                        </a>
                    </div>
                    
                    <div class="footer-name" style="text-align: center; margin-bottom: 20px;">
                        <h3 style="color: #ffffff; font-size: 24px; font-weight: 600; margin: 0; letter-spacing: 1px;">Murad Agamedov</h3>
                    </div>

                    <p class="description mt--30 footer-copyright">
                        © <script>document.write(new Date().getFullYear());</script>
                        {!! __("All rights reserved by <a target='_blank' href='https://muraddev.com'>Parv infotech.</a>") !!}
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Footer Area -->

<!-- Page Footer Code -->
@php
    $seoSettings = \App\Models\SeoSite::first();
@endphp
@if($seoSettings && $seoSettings->page_footer)
    {!! $seoSettings->page_footer !!}
@endif

<!-- Start Back To Top -->
<!-- Back to  top Start -->
<div class="backto-top">
    <div>
        <i data-feather="arrow-up"></i>
    </div>
</div>
<!-- Back to top end -->
<!-- End Back To Top -->

<!-- Modal Area -->
<!-- Start Modal Area  -->
<div class="demo-modal-area">
    <div class="wrapper">
        <div class="close-icon">
            <button class="demo-close-btn"><span class="feather-x"></span></button>
        </div>
        <div class="rn-modal-inner">
            <div class="demo-top text-center">
                <h4 class="title">Portfolio Details</h4>
                <p class="subtitle">View detailed information about my projects and work.</p>
            </div>

            <!-- Portfolio Modal Content -->
            <div class="portfolio-modal-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="portfolio-image">
                            <img src="" alt="Portfolio Image" id="modal-portfolio-image" class="w-100">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="portfolio-details">
                            <h3 class="title" id="modal-portfolio-title">Project Title</h3>
                            <p class="description" id="modal-portfolio-description">Project description will appear here.</p>

                            <div class="project-info">
                                <div class="info-item">
                                    <span class="label">Client:</span>
                                    <span class="value" id="modal-portfolio-client">Client Name</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Category:</span>
                                    <span class="value" id="modal-portfolio-category">Category</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Date:</span>
                                    <span class="value" id="modal-portfolio-date">Date</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Technologies:</span>
                                    <span class="value" id="modal-portfolio-tech">Technologies</span>
                                </div>
                            </div>

                            <div class="project-links mt-4">
                                <a href="#" class="btn btn-primary" id="modal-portfolio-link" target="_blank">
                                    <i class="feather-external-link"></i> View Project
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Area  -->

<!-- JS  -->
<!-- <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script> -->
<script src="{{ asset('assets/js/vendor/modernizer.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/feather.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script> -->
<script src="{{ asset('assets/js/vendor/bootstrap.js') }}"></script>
<!-- Custom typing animation instead of text-type.js -->
<!-- <script src="{{ asset('assets/js/vendor/text-type.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/vendor/wow.js') }}"></script>
<script src="{{ asset('assets/js/vendor/aos.js') }}"></script> -->
<script src="{{ asset('assets/js/vendor/particles.js') }}"></script>
<!-- <script src="{{ asset('assets/js/vendor/jquery-one-page-nav.js') }}"></script> -->
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script> <!-- script end -->



@stack('scripts')

<!-- Custom Mobile Menu JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            document.querySelector('.custom-mobile-menu').classList.add('active');
            document.body.classList.add('menu-open');
        });
    }
    
    // Close mobile menu
    const closeButtons = document.querySelectorAll('.mobile-menu-close, .mobile-menu-overlay');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.querySelector('.custom-mobile-menu').classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });
    
    // Close menu when clicking on menu items
    const menuItems = document.querySelectorAll('.mobile-menu-list a');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            document.querySelector('.custom-mobile-menu').classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const mobileMenu = document.querySelector('.custom-mobile-menu');
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        
        if (!mobileMenu.contains(e.target) && !menuToggle.contains(e.target)) {
            mobileMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });
    
    // Smooth scroll for navigation links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                const target = document.querySelector(href);
                if (target) {
                    const targetPosition = target.offsetTop - 100; // Offset for fixed header
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash
                    window.location.hash = href;
                }
            }
        });
    });
    
    // Active navigation highlighting
    window.addEventListener('scroll', function() {
        const scrollDistance = window.pageYOffset || document.documentElement.scrollTop;
        
        // Header scroll effect - make fixed when scrolling
        const header = document.querySelector('.rn-header');
        if (scrollDistance > 100) {
            header.classList.add('scrolled');
            document.body.classList.add('header-fixed');
        } else {
            header.classList.remove('scrolled');
            document.body.classList.remove('header-fixed');
        }
        
        // Active navigation highlighting
        const sections = document.querySelectorAll('section[id]');
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollDistance >= sectionTop && scrollDistance < sectionTop + sectionHeight) {
                // Remove active class from all nav links
                document.querySelectorAll('.primary-menu .nav-link.active').forEach(link => {
                    link.classList.remove('active');
                });
                
                // Add active class to current section's nav link
                const activeLink = document.querySelector('.primary-menu .nav-link[href="#' + sectionId + '"]');
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });
    });
    
    // Initialize header state on page load
    window.dispatchEvent(new Event('scroll'));
});
</script>

