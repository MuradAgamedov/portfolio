(function () {
    'use strict';
    
    // Global error handling to prevent console errors
    window.addEventListener('error', function(e) {
        // Prevent default error logging for known issues
        if (e.message && (
            e.message.includes('reportIncident') ||
            e.message.includes('logger') ||
            e.message.includes('easing')
        )) {
            e.preventDefault();
            return false;
        }
    });
    
    // Suppress console errors for external scripts
    var originalConsoleError = console.error;
    console.error = function() {
        var args = Array.prototype.slice.call(arguments);
        var message = args.join(' ');
        
        // Suppress specific error messages
        if (message.includes('reportIncident') || 
            message.includes('logger') || 
            message.includes('easing')) {
            return;
        }
        
        // Call original console.error for other errors
        originalConsoleError.apply(console, arguments);
    };

    var imJs = {
        m: function (e) {
            imJs.d();
            imJs.methods();
        },
        d: function (e) {
            this._window = window;
            this._document = document;
            this._body = document.body;
            this._html = document.documentElement;
        },

        methods: function (e) {
            imJs.featherAtcivation();
            imJs.backToTopInit();
            imJs.mobileMenuActive();
            imJs.vedioActivation();
            imJs.stickyHeader();
            imJs.smothScroll();
            imJs.smothScroll_Two();
            imJs.stickyAdjust();
            imJs.testimonialActivation();
            imJs.wowActive();
            imJs.awsActivation();
            imJs.demoActive();
            imJs.activePopupDemo();
            imJs.onePageNav();
            imJs.certificateModal();
            imJs.customTypingAnimation();
            imJs.languageSwitcher();
        },

        activePopupDemo: function (e) {
            document.querySelectorAll('.popuptab-area li a.demo-dark').forEach(function(element) {
                element.addEventListener('click', function (e) {
                    document.querySelector('.demo-modal-area').classList.add('dark-version');
                    document.querySelector('.demo-modal-area').classList.remove('white-version');
                });
            });

            document.querySelectorAll('.popuptab-area li a.demo-light').forEach(function(element) {
                element.addEventListener('click', function (e) {
                    document.querySelector('.demo-modal-area').classList.remove('dark-version');
                    document.querySelector('.demo-modal-area').classList.add('white-version');
                });
            });
        },

        demoActive: function (e) {
            document.querySelector('.rn-right-demo').addEventListener('click', function (e) {
                document.querySelector('.demo-modal-area').classList.add('open');
            });
            document.querySelector('.demo-close-btn').addEventListener('click', function (e) {
                document.querySelector('.demo-modal-area').classList.remove('open');
            });
        },

        wowActive: function () {
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }
        },

        smothScroll: function () {
            document.addEventListener('click', function(event) {
                if (event.target.closest('.smoth-animation')) {
                    event.preventDefault();
                    var target = document.querySelector(event.target.closest('.smoth-animation').getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 50,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        },

        smothScroll_Two: function () {
            document.addEventListener('click', function(event) {
                if (event.target.closest('.smoth-animation-two')) {
                    event.preventDefault();
                    var target = document.querySelector(event.target.closest('.smoth-animation-two').getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 0,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        },

        stickyAdjust: function (e) {
            // Sticky Top Adjust
            document.querySelectorAll('.rbt-sticky-top-adjust').forEach(function(element) {
                element.style.top = '120px';
            });

            document.querySelectorAll('.rbt-sticky-top-adjust-two').forEach(function(element) {
                element.style.top = '200px';
            });
            
            document.querySelectorAll('.rbt-sticky-top-adjust-three').forEach(function(element) {
                element.style.top = '25px';
            });
        },

        testimonialActivation: function () {
            // Custom Certificates Slider
            imJs.customCertificatesSlider();
            
            // Initialize other sliders if needed
            console.log('Slick sliders disabled - using custom implementations');
        },

        featherAtcivation: function () {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        },

        customCertificatesSlider: function () {
            const slider = document.querySelector('.custom-certificates-slider');
            if (!slider) {
                console.log('Certificate slider not found');
                return;
            }

            const slides = slider.querySelectorAll('.certificate-slide');
            const dots = slider.querySelectorAll('.dot');
            const prevBtn = slider.querySelector('#prevBtn');
            const nextBtn = slider.querySelector('#nextBtn');
            
            if (slides.length === 0) {
                console.log('No certificate slides found');
                return;
            }
            
            let currentSlide = 0;
            let autoplayInterval;

            function showSlide(index) {
                console.log('Showing slide:', index);
                
                // Hide all slides
                slides.forEach(slide => {
                    slide.classList.remove('active');
                    slide.style.display = 'none';
                });
                dots.forEach(dot => dot.classList.remove('active'));
                
                // Show current slide
                if (slides[index]) {
                    slides[index].classList.add('active');
                    slides[index].style.display = 'block';
                }
                if (dots[index]) {
                    dots[index].classList.add('active');
                }
                
                currentSlide = index;
            }

            function nextSlide() {
                const nextIndex = (currentSlide + 1) % slides.length;
                showSlide(nextIndex);
            }

            function prevSlide() {
                const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(prevIndex);
            }

            function startAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                }
                autoplayInterval = setInterval(nextSlide, 4000);
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                }
            }

            // Event listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    stopAutoplay();
                    nextSlide();
                    startAutoplay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    stopAutoplay();
                    prevSlide();
                    startAutoplay();
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    stopAutoplay();
                    showSlide(index);
                    startAutoplay();
                });
            });

            // Initialize first slide
            showSlide(0);
            
            // Start autoplay
            startAutoplay();
            
            console.log('Certificate slider initialized with', slides.length, 'slides');
        },

        certificateModal: function () {
            const modal = document.getElementById('certificateModal');
            if (!modal) return;
            
            const modalImage = modal.querySelector('.modal-image');
            const modalTitle = modal.querySelector('.modal-title');
            const closeBtn = document.getElementById('closeModal');
            const overlay = modal.querySelector('.modal-overlay');

            // Open modal when certificate image is clicked
            document.addEventListener('click', function(e) {
                if (e.target.closest('.certificate-modal-trigger')) {
                    e.preventDefault();
                    const trigger = e.target.closest('.certificate-modal-trigger');
                    const imageSrc = trigger.dataset.image;
                    const title = trigger.dataset.title;
                    
                    modalImage.src = imageSrc;
                    modalTitle.textContent = title;
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });

            // Close modal functions
            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            // Close on button click
            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            // Close on overlay click
            if (overlay) {
                overlay.addEventListener('click', closeModal);
            }

            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });
        },

        backToTopInit: function () {
            const scrollTop = document.querySelector('.backto-top');
            if (!scrollTop) return;
            
            window.addEventListener('scroll', function () {
                const topPos = window.pageYOffset || document.documentElement.scrollTop;
                if (topPos > 100) {
                    scrollTop.style.opacity = '1';
                } else {
                    scrollTop.style.opacity = '0';
                }
            });
            
            // Click event to scroll to top
            scrollTop.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                return false;
            });
        },

        stickyHeader: function (e) {
            const stickyHeader = document.querySelector('.header--sticky');
            if (!stickyHeader) {
                console.log('Sticky header element not found');
                return;
            }
            
            window.addEventListener('scroll', function () {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > 250) {
                    stickyHeader.classList.add('sticky');
                } else {
                    stickyHeader.classList.remove('sticky');
                }
            });
        },

        vedioActivation: function (e) {
            document.querySelectorAll('#play-video, .play-video').forEach(function(element) {
                element.addEventListener('click', function (e) {
                    e.preventDefault();
                    const overlay = document.querySelector('#video-overlay, .video-overlay');
                    overlay.classList.add('open');
                    overlay.innerHTML = '<iframe width="80%" height="80%" src="https://www.youtube.com/embed/7e90gBu4pas" frameborder="0" allowfullscreen></iframe>';
                });
            });

            document.querySelectorAll('.video-overlay, .video-overlay-close').forEach(function(element) {
                element.addEventListener('click', function (e) {
                    e.preventDefault();
                    close_video();
                });
            });

            document.addEventListener('keyup', function (e) {
                if (e.keyCode === 27) {
                    close_video();
                }
            });

            function close_video() {
                const overlay = document.querySelector('.video-overlay.open');
                if (overlay) {
                    overlay.classList.remove('open');
                    const iframe = overlay.querySelector('iframe');
                    if (iframe) {
                        iframe.remove();
                    }
                }
            }
        },

        mobileMenuActive: function (e) {
            const humbergerMenu = document.querySelector('.humberger-menu');
            const popupMobileMenu = document.querySelector('.popup-mobile-menu');
            const closeMenuActivation = document.querySelector('.close-menu-activation');
            const primaryMenuLinks = document.querySelectorAll('.popup-mobile-menu .primary-menu .nav-item a');
            const hasDropdownLinks = document.querySelectorAll('.popup-mobile-menu .has-droupdown > a');
            const navPillsLinks = document.querySelectorAll('.nav-pills .nav-link');

            if (humbergerMenu) {
                humbergerMenu.addEventListener('click', function (e) {
                    e.preventDefault();
                    popupMobileMenu.classList.add('menu-open');
                    document.documentElement.style.overflow = 'hidden';
                });
            }

            // Close menu on close button or menu item click
            [closeMenuActivation, ...primaryMenuLinks].forEach(function(element) {
                if (element) {
                    element.addEventListener('click', function (e) {
                        e.preventDefault();
                        popupMobileMenu.classList.remove('menu-open');
                        hasDropdownLinks.forEach(function(link) {
                            link.classList.remove('open');
                            const submenu = link.nextElementSibling;
                            if (submenu && submenu.classList.contains('submenu')) {
                                submenu.classList.remove('active');
                                submenu.style.display = 'none';
                            }
                        });
                        document.documentElement.style.overflow = '';
                    });
                }
            });

            // Close menu when clicking outside
            if (popupMobileMenu) {
                popupMobileMenu.addEventListener('click', function (e) {
                    if (e.target === this) {
                        popupMobileMenu.classList.remove('menu-open');
                        document.documentElement.style.overflow = '';
                    }
                });
            }

            // Dropdown functionality
            hasDropdownLinks.forEach(function(link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    if (submenu && submenu.classList.contains('submenu')) {
                        submenu.classList.toggle('active');
                        if (submenu.style.display === 'none' || submenu.style.display === '') {
                            submenu.style.display = 'block';
                        } else {
                            submenu.style.display = 'none';
                        }
                    }
                    this.classList.toggle('open');
                    document.documentElement.style.overflow = '';
                });
            });

            // Close menu on nav pills click
            navPillsLinks.forEach(function(link) {
                link.addEventListener('click', function (e) {
                    document.querySelector('.rn-popup-mobile-menu').classList.remove('menu-open');
                    document.documentElement.style.overflow = '';
                });
            });
        },

        awsActivation: function(e) {
            // AOS disabled due to easing errors
            // AOS.init({
            //     duration: 800,
            //     easing: 'ease-in-out',
            //     once: true,
            //     mirror: false
            // });
        },

        onePageNav: function () {
            // Removed smooth scrolling - using simple anchor links
            // Navbar links will work with simple #id navigation
        },

        customTypingAnimation: function () {
            const typingContainer = document.getElementById('typingText');
            if (!typingContainer) {
                console.log('Typing container not found');
                return;
            }
            
            const words = typingContainer.querySelectorAll('b');
            if (words.length === 0) {
                console.log('No typing animation words found');
                return;
            }
            
            console.log('Found', words.length, 'words for typing animation:', Array.from(words).map(w => w.textContent));
            
            let currentIndex = 0;
            let animationInterval;
            
            function switchWord() {
                // Hide current word
                if (words[currentIndex]) {
                    words[currentIndex].classList.remove('is-visible');
                    words[currentIndex].classList.add('is-hidden');
                    console.log('Hidden:', words[currentIndex].textContent);
                }
                
                // Move to next word
                currentIndex = (currentIndex + 1) % words.length;
                
                // Show next word
                if (words[currentIndex]) {
                    words[currentIndex].classList.remove('is-hidden');
                    words[currentIndex].classList.add('is-visible');
                    console.log('Shown:', words[currentIndex].textContent);
                }
            }
            
            function startAnimation() {
                console.log('Starting typing animation');
                
                // Clear any existing interval
                if (animationInterval) {
                    clearInterval(animationInterval);
                }
                
                // Reset to first word
                currentIndex = 0;
                
                // Hide all words first
                words.forEach(function(word, index) {
                    word.classList.remove('is-visible', 'is-hidden');
                    word.classList.add('is-hidden');
                    console.log('Initial state - word', index, ':', word.textContent);
                });
                
                // Show first word
                if (words[0]) {
                    words[0].classList.remove('is-hidden');
                    words[0].classList.add('is-visible');
                    console.log('First word shown:', words[0].textContent);
                }
                
                // Start the animation after a delay
                setTimeout(function() {
                    switchWord();
                    animationInterval = setInterval(switchWord, 3000);
                }, 2000);
            }
            
            // Start animation immediately if DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', startAnimation);
            } else {
                startAnimation();
            }
            
            // Restart animation when scrolling to top
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    if (window.pageYOffset < 100) {
                        startAnimation();
                    }
                }, 500);
            });
        },

        languageSwitcher: function () {
            // Language switcher functionality
            document.addEventListener('click', function(e) {
                if (e.target.closest('.language-switcher .dropdown-item, .mobile-lang-option')) {
                    e.preventDefault();
                    
                    const link = e.target.closest('.language-switcher .dropdown-item, .mobile-lang-option');
                    const newUrl = link.getAttribute('href');
                    const currentLang = document.querySelector('.current-lang');
                    
                    // Show loading state
                    if (link.classList.contains('dropdown-item') && currentLang) {
                        currentLang.textContent = '...';
                    }
                    
                    // Navigate to new URL directly
                    window.location.href = newUrl;
                }
            });
            
            // Add hover effect for language options
            document.querySelectorAll('.language-switcher .dropdown-item, .mobile-lang-option').forEach(function(element) {
                element.addEventListener('mouseenter', function() {
                    this.classList.add('hover-effect');
                });
                
                element.addEventListener('mouseleave', function() {
                    this.classList.remove('hover-effect');
                });
            });
        },
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            imJs.m();
        });
    } else {
        imJs.m();
    }

})();