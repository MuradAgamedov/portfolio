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
                
                // Navigate to contact page using localized route
                const currentLang = window.location.pathname.split('/')[1];
                const contactUrl = currentLang && currentLang !== 'contact' ? `/${currentLang}/contact` : '/contact';
                window.location.href = contactUrl;
            }
            // For email and WhatsApp, let the default link behavior work
        });
    });
}); 