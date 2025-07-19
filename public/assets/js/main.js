(function ($) {
    'use strict';

    var imJs = {
        m: function (e) {
            imJs.d();
            imJs.methods();
        },
        d: function (e) {
            this._window = $(window),
            this._document = $(document),
            this._body = $('body'),
            this._html = $('html')

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
            imJs.fixTypingAnimation();
        },

        
        activePopupDemo: function (e) {
            $('.popuptab-area li a.demo-dark').on('click', function (e) {
                $('.demo-modal-area').addClass('dark-version');
                $('.demo-modal-area').removeClass('white-version');
            });

            $('.popuptab-area li a.demo-light').on('click', function (e) {
                $('.demo-modal-area').removeClass('dark-version');
                $('.demo-modal-area').addClass('white-version');
            })
        },

        demoActive: function (e) {
            $('.rn-right-demo').on('click', function (e) {
                $('.demo-modal-area').addClass('open');
            })
            $('.demo-close-btn').on('click', function (e) {
                $('.demo-modal-area').removeClass('open');
            })
        },

    

        
        
        wowActive: function () {
            new WOW().init();
        },

        smothScroll: function () {
            $(document).on('click', '.smoth-animation', function (event) {
                event.preventDefault();
                var target = $($.attr(this, 'href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 50
                    }, 300);
                }
            });
        },
        // two scroll spy
        smothScroll_Two: function () {
            $(document).on('click', '.smoth-animation-two', function (event) {
                event.preventDefault();
                var target = $($.attr(this, 'href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 0
                    }, 300);
                }
            });
        },


        stickyAdjust: function (e) {
            // Sticky Top Adjust..,
            $('.rbt-sticky-top-adjust').css({
                top: 120
            });

            $('.rbt-sticky-top-adjust-two').css({
                top: 200
            });
            $('.rbt-sticky-top-adjust-three').css({
                top: 25
            });
        },

        testimonialActivation: function () {
            $('.testimonial-activation').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>'
            });

            // Custom Certificates Slider
            imJs.customCertificatesSlider();

            $('.testimonial-item-one').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-chevron-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-chevron-right"></i></button>',
                responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        arrows: false,
                    }
                }]
            });


            $('.portfolio-slick-activation').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                cssEase: 'linear',
                adaptiveHeight: true,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
                responsive: [{
                        breakpoint: 1124,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 868,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            arrows: false,
                        }
                    }
                ]
            });


            $('.blog-slick-activation').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                cssEase: 'linear',
                adaptiveHeight: true,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
                responsive: [{
                        breakpoint: 1124,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 868,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            arrows: false,
                        }
                    }
                ]
            });

            $('.testimonial-activation-item-3').slick({
                arrows: true,
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                adaptiveHeight: true,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-chevron-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-chevron-right"></i></button>',
                responsive: [{
                        breakpoint: 1124,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    }
                ]
            });

            $('.brand-activation-item-5').slick({
                arrows: true,
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 4,
                slidesToScroll: 1,
                adaptiveHeight: true,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="feather-chevron-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="feather-chevron-right"></i></button>',
                responsive: [{
                        breakpoint: 1124,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 868,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        },

        featherAtcivation: function () {
            feather.replace();
        },

        customCertificatesSlider: function () {
            const slider = $('.custom-certificates-slider');
            if (slider.length === 0) return;

            const slides = slider.find('.certificate-slide');
            const dots = slider.find('.dot');
            const prevBtn = slider.find('#prevBtn');
            const nextBtn = slider.find('#nextBtn');
            
            let currentSlide = 0;
            let autoplayInterval;

            function showSlide(index) {
                // Hide all slides
                slides.removeClass('active');
                dots.removeClass('active');
                
                // Show current slide
                slides.eq(index).addClass('active');
                dots.eq(index).addClass('active');
                
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
                autoplayInterval = setInterval(nextSlide, 4000);
            }

            function stopAutoplay() {
                clearInterval(autoplayInterval);
            }

            // Event listeners
            nextBtn.on('click', function() {
                stopAutoplay();
                nextSlide();
                startAutoplay();
            });

            prevBtn.on('click', function() {
                stopAutoplay();
                prevSlide();
                startAutoplay();
            });

            dots.on('click', function() {
                const slideIndex = $(this).data('slide');
                stopAutoplay();
                showSlide(slideIndex);
                startAutoplay();
            });



            // Start autoplay
            startAutoplay();
        },

        certificateModal: function () {
            const modal = $('#certificateModal');
            const modalImage = modal.find('.modal-image');
            const modalTitle = modal.find('.modal-title');
            const closeBtn = $('#closeModal');
            const overlay = modal.find('.modal-overlay');

            // Open modal when certificate image is clicked
            $(document).on('click', '.certificate-modal-trigger', function(e) {
                e.preventDefault();
                const imageSrc = $(this).data('image');
                const title = $(this).data('title');
                
                modalImage.attr('src', imageSrc);
                modalTitle.text(title);
                modal.addClass('active');
                $('body').css('overflow', 'hidden');
            });

            // Close modal functions
            function closeModal() {
                modal.removeClass('active');
                $('body').css('overflow', 'auto');
            }

            // Close on button click
            closeBtn.on('click', closeModal);

            // Close on overlay click
            overlay.on('click', closeModal);

            // Close on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && modal.hasClass('active')) {
                    closeModal();
                }
            });
        },


        backToTopInit: function () {
            // declare variable
            var scrollTop = $('.backto-top');
            $(window).scroll(function () {
                // declare variable
                var topPos = $(this).scrollTop();
                // if user scrolls down - show scroll to top button
                if (topPos > 100) {
                    $(scrollTop).css('opacity', '1');

                } else {
                    $(scrollTop).css('opacity', '0');
                }
            });
            
            //Click event to scroll to top
            $(scrollTop).on('click', function () {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                return false;
            });

        },

        stickyHeader: function (e) {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 250) {
                    $('.header--sticky').addClass('sticky')
                } else {
                    $('.header--sticky').removeClass('sticky')
                }
            })
        },

        vedioActivation: function (e) {
            $('#play-video, .play-video').on('click', function (e) {
                e.preventDefault();
                $('#video-overlay, .video-overlay').addClass('open');
                $("#video-overlay, .video-overlay").append('<iframe width="80%" height="80%" src="https://www.youtube.com/embed/7e90gBu4pas" frameborder="0" allowfullscreen></iframe>');
            });

            $('.video-overlay, .video-overlay-close').on('click', function (e) {
                e.preventDefault();
                close_video();
            });

            $(document).keyup(function (e) {
                if (e.keyCode === 27) {
                    close_video();
                }
            });

            function close_video() {
                $('.video-overlay.open').removeClass('open').find('iframe').remove();
            };
        },

        mobileMenuActive: function (e) {

            $('.humberger-menu').on('click', function (e) {
                e.preventDefault();
                $('.popup-mobile-menu').addClass('menu-open');
                imJs._html.css({
                    overflow: 'hidden'
                })
            });

            $('.close-menu-activation, .popup-mobile-menu .primary-menu .nav-item a').on('click', function (e) {
                e.preventDefault();
                $('.popup-mobile-menu').removeClass('menu-open');
                $('.popup-mobile-menu .has-droupdown > a').removeClass('open').siblings('.submenu').removeClass('active').slideUp('400');
                imJs._html.css({
                    overflow: ''
                })
            });

            $('.popup-mobile-menu').on('click', function (e) {
                e.target === this && $('.popup-mobile-menu').removeClass('menu-open');
                imJs._html.css({
                    overflow: ''
                })
            });

            $('.popup-mobile-menu .has-droupdown > a').on('click', function (e) {
                e.preventDefault();
                $(this).siblings('.submenu').toggleClass('active').slideToggle('400');
                $(this).toggleClass('open');
                imJs._html.css({
                    overflow: ''
                })
            });


            $('.nav-pills .nav-link').on('click', function (e) {
                $('.rn-popup-mobile-menu').removeClass('menu-open');
                imJs._html.css({
                    overflow: ''
                })
            })

        },

        awsActivation:function(e){
            // AOS disabled due to easing errors
            // AOS.init({
            //     duration: 800,
            //     easing: 'ease-in-out',
            //     once: true,
            //     mirror: false
            // });
        },

        onePageNav: function () {
            // Simple smooth scrolling for navbar links
            $('.onepagenav a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                }
            });
            
            // Simple active state management
            $(window).scroll(function() {
                var scrollDistance = $(window).scrollTop();
                
                $('section[id]').each(function(i) {
                    if ($(this).position().top - 100 <= scrollDistance) {
                        $('.onepagenav .nav-link.active').removeClass('active');
                        $('.onepagenav a[href="#' + $(this).attr('id') + '"]').addClass('active');
                    }
                });
            });
        },

        fixTypingAnimation: function () {
            // Fix typing animation when scrolling
            let typingAnimation = null;
            
            function restartTypingAnimation() {
                if (typingAnimation) {
                    clearTimeout(typingAnimation);
                }
                
                // Reset typing animation
                $('.cd-headline .cd-words-wrapper b').removeClass('is-visible is-hidden').addClass('is-hidden');
                $('.cd-headline .cd-words-wrapper b:first').removeClass('is-hidden').addClass('is-visible');
                
                // Restart animation after a short delay
                typingAnimation = setTimeout(function() {
                    // Trigger the typing animation again
                    $('.cd-headline').each(function() {
                        var $headline = $(this);
                        var $wordsWrapper = $headline.find('.cd-words-wrapper');
                        var $words = $wordsWrapper.find('b');
                        
                        if ($words.length > 1) {
                            // Simple typing animation restart
                            var currentIndex = 0;
                            
                            function showNextWord() {
                                $words.removeClass('is-visible').addClass('is-hidden');
                                $words.eq(currentIndex).removeClass('is-hidden').addClass('is-visible');
                                currentIndex = (currentIndex + 1) % $words.length;
                            }
                            
                            // Start the animation
                            showNextWord();
                            
                            // Set interval for word changes
                            setInterval(showNextWord, 3000);
                        }
                    });
                }, 100);
            }
            
            // Restart animation when page loads
            $(document).ready(function() {
                restartTypingAnimation();
            });
            
            // Restart animation when scrolling to top
            $(window).scroll(function() {
                if ($(window).scrollTop() < 100) {
                    restartTypingAnimation();
                }
            });
        },

    }
    imJs.m();


})(jQuery, window)