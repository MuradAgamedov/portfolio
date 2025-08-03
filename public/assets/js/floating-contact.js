document.addEventListener('DOMContentLoaded', function() {
    // Floating Contact Button Scroll Effect
    const floatingBtn = document.querySelector('.floating-contact-btn');
    let lastScrollTop = 0;

    if (floatingBtn) {
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 300) {
                floatingBtn.style.opacity = '1';
                floatingBtn.style.transform = 'translateY(0)';
            } else {
                floatingBtn.style.opacity = '0.7';
                floatingBtn.style.transform = 'translateY(10px)';
            }
            
            lastScrollTop = scrollTop;
        });
    }

    // Contact Popup Modal Functionality
    const contactFloatBtn = document.getElementById('contactFloatBtn');
    const contactPopupModal = document.getElementById('contactPopupModal');
    const popupClose = document.getElementById('popupClose');

    console.log('Contact Float Button:', contactFloatBtn);
    console.log('Contact Popup Modal:', contactPopupModal);
    console.log('Popup Close:', popupClose);

    // Open popup
    if (contactFloatBtn) {
        contactFloatBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Contact button clicked!');
            
            if (contactPopupModal) {
                contactPopupModal.classList.add('show');
                console.log('Modal should be visible now');
                
                // Initialize Feather icons in popup
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            } else {
                console.error('Modal not found!');
            }
        });
    } else {
        console.error('Contact float button not found!');
    }

    // Close popup
    function closePopup() {
        if (contactPopupModal) {
            contactPopupModal.classList.remove('show');
            console.log('Modal closed');
        }
    }

    if (popupClose) {
        popupClose.addEventListener('click', closePopup);
    }

    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && contactPopupModal && contactPopupModal.classList.contains('show')) {
            closePopup();
        }
    });

    // Handle contact options
    document.querySelectorAll('.contact-option').forEach(option => {
        option.addEventListener('click', function(e) {
            const action = this.getAttribute('data-action');
            
            if (action === 'contact-form') {
                e.preventDefault();
                closePopup();
                
                // Check if we're on contact page
                const isContactPage = window.location.pathname.includes('/contact');
                
                if (isContactPage) {
                    // Smooth scroll to contact section
                    const contactSection = document.querySelector('#contacts');
                    if (contactSection) {
                        setTimeout(() => {
                            contactSection.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }, 300);
                    }
                } else {
                    // Navigate to contact page
                    window.location.href = '/contact';
                }
            } else if (action === 'whatsapp') {
                e.preventDefault();
                closePopup();
                
                // Check if we're on contact page
                const isContactPage = window.location.pathname.includes('/contact');
                
                if (isContactPage) {
                    // Click the WhatsApp link on contact page
                    const contactWhatsappLink = document.getElementById('contact-whatsapp-link');
                    if (contactWhatsappLink) {
                        contactWhatsappLink.click();
                    }
                } else {
                    // Navigate to contact page and then click WhatsApp
                    window.location.href = '/contact#whatsapp';
                }
            }
            // For email, let the default link behavior work
        });
    });
}); 