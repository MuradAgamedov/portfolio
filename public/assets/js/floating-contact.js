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

    // Success Modal Function
    function showSuccessModal(message) {
        // Create success modal HTML
        const successModalHTML = `
            <div class="success-modal-overlay" id="successModalOverlay">
                <div class="success-modal">
                    <div class="success-modal-content">
                        <div class="success-icon">
                            <i data-feather="check-circle"></i>
                        </div>
                        <h4>Uğurlu!</h4>
                        <p>${message}</p>
                        <button class="success-modal-btn" onclick="closeSuccessModal()">
                            <i data-feather="check"></i>
                            Tamam
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', successModalHTML);
        
        // Initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Auto close after 3 seconds
        setTimeout(() => {
            closeSuccessModal();
        }, 3000);
    }

    // Error Modal Function
    function showErrorModal(message) {
        // Create error modal HTML
        const errorModalHTML = `
            <div class="error-modal-overlay" id="errorModalOverlay">
                <div class="error-modal">
                    <div class="error-modal-content">
                        <div class="error-icon">
                            <i data-feather="alert-circle"></i>
                        </div>
                        <h4>Xəta!</h4>
                        <p>${message}</p>
                        <button class="error-modal-btn" onclick="closeErrorModal()">
                            <i data-feather="x"></i>
                            Bağla
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', errorModalHTML);
        
        // Initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    // Close Success Modal
    window.closeSuccessModal = function() {
        const modal = document.getElementById('successModalOverlay');
        if (modal) {
            modal.remove();
        }
    };

    // Close Error Modal
    window.closeErrorModal = function() {
        const modal = document.getElementById('errorModalOverlay');
        if (modal) {
            modal.remove();
        }
    };

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
            } else if (action === 'email-form') {
                e.preventDefault();
                
                // Show email form
                document.getElementById('contactOptionsView').style.display = 'none';
                document.getElementById('emailFormView').style.display = 'block';
                
                // Initialize Feather icons in form
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
            // For WhatsApp, let the default link behavior work
        });
    });

    // Back button functionality
    const backToOptions = document.getElementById('backToOptions');
    if (backToOptions) {
        backToOptions.addEventListener('click', function() {
            document.getElementById('emailFormView').style.display = 'none';
            document.getElementById('contactOptionsView').style.display = 'block';
        });
    }

    // Email form submission
    const emailForm = document.getElementById('emailForm');
    if (emailForm) {
        emailForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i data-feather="loader"></i><span>Göndərilir...</span>';
            submitBtn.disabled = true;
            
            // Initialize feather icons for loading
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
            
            // Get current language for URL
            const currentLang = window.location.pathname.split('/')[1];
            const url = currentLang && currentLang !== 'quick-contact' ? `/${currentLang}/quick-contact` : '/quick-contact';
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success modal
                    showSuccessModal(data.message);
                    
                    // Reset form
                    this.reset();
                    
                    // Close popup
                    closePopup();
                } else {
                    showErrorModal('Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Initialize feather icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            });
        });
    }
}); 