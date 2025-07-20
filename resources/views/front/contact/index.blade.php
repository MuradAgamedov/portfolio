@extends('front.layouts.master')

@section('title', __('Contact'))

@section('content')
@include('front.partials.contact-section')
@endsection

@push('scripts')
<!-- Contact Form AJAX -->
<script>
$(document).ready(function() {
    // Contact form submission
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        var formData = new FormData(this);
        
        // Show loading state
        var submitBtn = $('#submit');
        var originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> {{__("Sending...")}}');
        submitBtn.prop('disabled', true);
        
        // AJAX request
        $.ajax({
            url: '{{ route("contact") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: '{{__("Success!")}}',
                    text: '{{__("Thank you for your message! We will get back to you soon.")}}',
                    confirmButtonText: '{{__("OK")}}',
                    confirmButtonColor: '#667eea'
                });
                
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
                var errorMessage = '{{__("An error occurred. Please try again.")}}';
                
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
                Swal.fire({
                    icon: 'error',
                    title: '{{__("Error!")}}',
                    text: errorMessage,
                    confirmButtonText: '{{__("OK")}}',
                    confirmButtonColor: '#dc3545'
                });
                
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
            showFieldError(field, '{{__("Name is required")}}');
        } else if (fieldName === 'contact-email' && value === '') {
            showFieldError(field, '{{__("Email is required")}}');
        } else if (fieldName === 'contact-email' && value !== '' && !isValidEmail(value)) {
            showFieldError(field, '{{__("Please enter a valid email address")}}');
        } else if (fieldName === 'subject' && value === '') {
            showFieldError(field, '{{__("Subject is required")}}');
        } else if (fieldName === 'contact-message' && value === '') {
            showFieldError(field, '{{__("Message is required")}}');
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
</script>
@endpush

@push('styles')
<style>
/* Contact form button styling for contact page */
.contact-form-wrapper .rn-btn {
    width: 100% !important;
    display: block !important;
    text-align: center !important;
    margin: 0 auto !important;
}

.contact-form-wrapper .rn-btn span {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
}

/* Ensure consistent button styling across contact pages */
.rn-contact-area .contact-form-wrapper .rn-btn {
    width: 100% !important;
    display: block !important;
    text-align: center !important;
    padding: 15px 35px !important;
    border-radius: 6px !important;
    background: linear-gradient(145deg, #1e2024, #23272b) !important;
    box-shadow: var(--shadow-1) !important;
    transition: var(--transition) !important;
    position: relative !important;
    z-index: 2 !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: 0 none !important;
    color: var(--color-primary) !important;
}

.rn-contact-area .contact-form-wrapper .rn-btn:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
}

.rn-contact-area .contact-form-wrapper .rn-btn::before {
    content: "" !important;
    position: absolute !important;
    transition: var(--transition) !important;
    width: 100% !important;
    height: 100% !important;
    border-radius: 6px !important;
    top: 0 !important;
    left: 0 !important;
    background: linear-gradient(to right bottom, #212428, #16181c) !important;
    opacity: 0 !important;
    z-index: -1 !important;
}

.rn-contact-area .contact-form-wrapper .rn-btn:hover::before {
    opacity: 1 !important;
}

/* Responsive adjustments */
@media only screen and (max-width: 767px) {
    .contact-form-wrapper .rn-btn {
        width: 100% !important;
        margin: 0 !important;
    }
}

@media only screen and (max-width: 479px) {
    .contact-form-wrapper .rn-btn {
        width: 100% !important;
        display: block !important;
        text-align: center !important;
    }
}

/* Custom styling for form validation */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

/* Loading spinner for button */
.fa-spinner {
    margin-right: 5px;
}
</style>
@endpush


 