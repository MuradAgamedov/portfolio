/**
 * Contact Form JavaScript
 * Handles form submission, validation, and reCAPTCHA reset
 */

$(document).ready(function() {
    // Contact form submission
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        var formData = new FormData(this);
        
        // Show loading state
        var submitBtn = $('#submit');
        var originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
        submitBtn.prop('disabled', true);
        
        // AJAX request
        $.ajax({
            url: '/contact',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
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
                $('#contact-form')[0].reset();
                
                // Reset reCAPTCHA
                if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
                    grecaptcha.reset();
                }
                
                // Reset button
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            },
            error: function(xhr) {
                var errorMessage = 'An error occurred. Please try again.';
                
                // Check if there are validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorList = '';
                    
                    for (var field in errors) {
                        errorList += errors[field][0] + '\n';
                    }
                    
                    errorMessage = errorList;
                }
                
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
                
                // Reset button
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        });
    });
    
    // Form validation on input
    $('#contact-form input, #contact-form textarea').on('blur', function() {
        var field = $(this);
        var value = field.val().trim();
        var fieldName = field.attr('name');
        
        // Remove existing error styling
        field.removeClass('is-invalid');
        field.siblings('.invalid-feedback').remove();
        
        // Validate required fields
        if (fieldName === 'contact-name' && value === '') {
            showFieldError(field, 'Name is required');
        } else if (fieldName === 'contact-email' && value === '') {
            showFieldError(field, 'Email is required');
        } else if (fieldName === 'contact-email' && value !== '' && !isValidEmail(value)) {
            showFieldError(field, 'Please enter a valid email address');
        } else if (fieldName === 'subject' && value === '') {
            showFieldError(field, 'Subject is required');
        } else if (fieldName === 'contact-message' && value === '') {
            showFieldError(field, 'Message is required');
        }
    });
    
    function showFieldError(field, message) {
        field.addClass('is-invalid');
        field.after('<div class="invalid-feedback">' + message + '</div>');
    }
    
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Clear validation errors on input
    $('#contact-form input, #contact-form textarea').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').remove();
    });
}); 