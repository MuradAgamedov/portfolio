<!-- Start Footer Area -->
<div class="rn-footer-area rn-section-gap section-separator">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-area text-center">

                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @php
                                $footerLogo = \App\Models\SiteSetting::getByKey('footer_logo');
                                $footerLogoAlt = \App\Models\SiteSetting::getByKey('footer_logo_alt');
                            @endphp
                            @if($footerLogo)
                                <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ $footerLogoAlt ?: 'logo' }}">
                            @else
                                <img src="{{ asset('assets/images/logo/logo-vertical.png') }}" alt="logo">
                            @endif
                        </a>
                    </div>

                    <p class="description mt--30">© <script>document.write(new Date().getFullYear());</script>2025. All rights reserved by <a target="_blank" href="https://themeforest.net/user/parvinfotech/portfolio">Parv infotech.</a></p>
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
<script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('assets/js/vendor/modernizer.min.js') }}"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/vendor/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/vendor/text-type.js') }}"></script>
<script src="{{ asset('assets/js/vendor/wow.js') }}"></script>
<script src="{{ asset('assets/js/vendor/aos.js') }}"></script>
<script src="{{ asset('assets/js/vendor/particles.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-one-page-nav.js') }}"></script>
<!-- main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script> <!-- script end -->

@stack('scripts')

