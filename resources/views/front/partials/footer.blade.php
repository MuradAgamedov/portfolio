<!-- Start Footer Area -->
<div id="footer" class="rn-footer-area footer-style-2 rn-section-gapTop section-separator">
    <div class="container pb--80 pb_sm--40 plr_sm--20">
        <div class="row">
            <div class="col-xl-3 col-12 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="logo-thumbnail">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo-image"></a>
                </div>
                <div class="social-icone-wrapper">
                    <ul class="social-share d-flex liststyle">
                        <li class="facebook"><a href="#"><i data-feather="linkedin"></i></a></li>
                        <li class="instagram"><a href="#"><i data-feather="instagram"></i></a></li>
                        <li class="linkedin"><a href="#"><i data-feather="twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sl-3 col-12 mt_sm--20 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="menu-wrapper">
                    <div class="menu-title">
                        <h6>Services</h6>
                    </div>
                    <ul class="menu-footer">
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#resume">Resume</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sl-3 col-12 mt_sm--20 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="menu-wrapper">
                    <div class="menu-title">
                        <h6>Resources</h6>
                    </div>
                    <ul class="menu-footer">
                        <li><a href="#experience">Experience</a></li>
                        <li><a href="#education">Education</a></li>
                        <li><a href="#skills">Skills</a></li>
                        <li><a href="#certificates">Certificates</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sl-3 col-12 mt_sm--20 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="menu-wrapper">
                    <div class="menu-title">
                        <h6>Contact</h6>
                    </div>
                    <ul class="menu-footer">
                        <li><a href="mailto:contact@example.com">Email</a></li>
                        <li><a href="tel:+1234567890">Phone</a></li>
                        <li><a href="#contact">Contact Form</a></li>
                        <li><a href="#">Location</a></li>
                        <li><a href="#">Social Media</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center ptb--40 section-separator">
        <p class="description">© {{ date('Y') }}. All rights reserved by <a target="_blank" href="#">Murad Portfolio</a></p>
    </div>
</div>
<!-- End Footer Area -->

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
