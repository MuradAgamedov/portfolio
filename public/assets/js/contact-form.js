/**
 * Contact Form JavaScript
 * Handles form submission, validation, and reCAPTCHA reset
 */

document.addEventListener('DOMContentLoaded', function() {
    // Contact form submission
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            var formData = new FormData(this);
            
            // Show loading state
            var submitBtn = document.getElementById('submit');
            var originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // AJAX request
            var formAction = contactForm.getAttribute('data-action') || '/contact';
            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                           document.querySelector('input[name="_token"]')?.value;
            
            fetch(formAction, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                // Show success message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Thank you for your message! We will get back to you soon.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#667eea'
                    });
                } else {
                    alert('Thank you for your message! We will get back to you soon.');
                }
                
                // Reset form
                contactForm.reset();
                
                // Reset reCAPTCHA
                if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
                    grecaptcha.reset();
                }
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            })
            .catch(error => {
                var errorMessage = 'An error occurred. Please try again.';
                
                // Check if there are validation errors
                if (error.status === 422) {
                    error.json().then(function(data) {
                        var errors = data.errors;
                        var errorList = '';
                        
                        for (var field in errors) {
                            errorList += errors[field][0] + '\n';
                        }
                        
                        errorMessage = errorList;
                        
                        // Show error message
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errorMessage,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        } else {
                            alert('Error: ' + errorMessage);
                        }
                    });
                } else {
                    // Show error message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        alert('Error: ' + errorMessage);
                    }
                }
                
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Form validation on input
    const formInputs = document.querySelectorAll('#contact-form input, #contact-form textarea');
    formInputs.forEach(function(input) {
        input.addEventListener('blur', function() {
            var value = this.value.trim();
            var fieldName = this.getAttribute('name');
            
            // Remove existing error styling
            this.classList.remove('is-invalid');
            const existingError = this.parentNode.querySelector('.invalid-feedback');
            if (existingError) {
                existingError.remove();
            }
            
            // Validate required fields
            if (fieldName === 'contact-name' && value === '') {
                showFieldError(this, 'Name is required');
            } else if (fieldName === 'contact-email' && value === '') {
                showFieldError(this, 'Email is required');
            } else if (fieldName === 'contact-email' && value !== '' && !isValidEmail(value)) {
                showFieldError(this, 'Please enter a valid email address');
            } else if (fieldName === 'subject' && value === '') {
                showFieldError(this, 'Subject is required');
            } else if (fieldName === 'contact-message' && value === '') {
                showFieldError(this, 'Message is required');
            }
        });
        
        // Clear validation errors on input
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const existingError = this.parentNode.querySelector('.invalid-feedback');
            if (existingError) {
                existingError.remove();
            }
        });
    });
    
    function showFieldError(field, message) {
        field.classList.add('is-invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }
    
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}); 