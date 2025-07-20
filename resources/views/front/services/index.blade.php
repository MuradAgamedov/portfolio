@extends('front.layouts.master')

@section('title', __('Services'))

@section('content')
<!-- Start Services Area -->
<div class="rn-service-area rn-section-gap section-separator" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title">
                    <div class="title-column">
                        <span class="subtitle">{{__("What I can do for you")}}</span>
                        <h2 class="title">{{__("My Services")}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row--25 mt--30 mt_md--10 mt_sm--10">
            @forelse($services as $index => $service)
                @include('front.partials.service-card', ['service' => $service, 'index' => $index, 'isServicesPage' => true])
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i data-feather="info"></i>
                    {{__('No services found.')}}
                </div>
            </div>
            @endforelse
        </div>

        <!-- Service Request Form -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="200" data-aos-once="true" class="service-request-form">
                    <div class="form-header">
                        <h3>{{__('Request a Service')}}</h3>
                        <p>{{__('Select a service and send us your request')}}</p>
                    </div>
                    
                    <form class="service-form" id="serviceRequestForm">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="service_select">{{__('Select Service')}} *</label>
                                    <select id="service_select" name="service_id" class="form-control" required>
                                        <option value="">{{__('Choose a service...')}}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" data-title="{{ $service->getTitle() }}">
                                                {{ $service->getTitle() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="subject">{{__('Subject')}} *</label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="{{__('Enter subject...')}}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">{{__('Message')}} *</label>
                            <textarea id="message" name="message" class="form-control" rows="6" placeholder="{{__('Describe your project requirements...')}}" required></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="send"></i>
                                <span>{{__('Send Request')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Services Area -->
@endsection

@section('styles')
<style>
/* Section Title Styles */
.section-title .title-column {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
    text-align: left;
}

.section-title .subtitle {
    font-size: 16px;
    color: var(--color-body);
    font-weight: 400;
    margin: 0;
}

.section-title .title {
    font-size: 48px;
    font-weight: 700;
    color: var(--color-heading);
    margin: 0;
}



/* Service Request Form Styles */
.service-request-form {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: 50px;
}

.form-header {
    text-align: center;
    margin-bottom: 30px;
}

.form-header h3 {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 10px;
}

.form-header p {
    color: var(--color-body);
    font-size: 16px;
    margin: 0;
}

.service-form .form-group {
    margin-bottom: 25px;
}

.service-form label {
    display: block;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 8px;
    font-size: 14px;
}

.service-form .form-control {
    width: 100%;
    padding: 15px 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--color-heading);
    font-size: 15px;
    backdrop-filter: blur(6px);
    transition: all 0.3s ease;
}

.service-form .form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.1);
}

.service-form .form-control::placeholder {
    color: var(--color-body);
}

.service-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.form-actions {
    text-align: center;
    margin-top: 30px;
}

.btn-primary {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    color: white;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(var(--color-primary-rgb), 0.3);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(var(--color-primary-rgb), 0.4);
}

.btn-primary i {
    width: 18px;
    height: 18px;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .section-title .title-column {
        text-align: center;
        align-items: center;
        gap: 10px;
    }
    
    .section-title .title {
        font-size: 36px;
    }
    
    .service-request-form {
        padding: 25px;
    }
    
    .form-header h3 {
        font-size: 24px;
    }
}

@media only screen and (max-width: 575px) {
    .section-title .title {
        font-size: 28px;
    }
    
    .service-request-form {
        padding: 20px;
    }
    
    .rn-service .inner {
        padding: 20px;
    }
    
    .rn-service .title {
        font-size: 18px;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_select');
    const subjectInput = document.getElementById('subject');
    
    // Update subject when service is selected
    serviceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const serviceTitle = selectedOption.getAttribute('data-title');
            subjectInput.value = `Service Request: ${serviceTitle}`;
        } else {
            subjectInput.value = '';
        }
    });
    
    // Form submission (for now, just prevent default)
    document.getElementById('serviceRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Form submission logic will be added later
        console.log('Form submitted');
    });
});

// Function to select service from service cards
function selectService(serviceId, serviceTitle) {
    const serviceSelect = document.getElementById('service_select');
    const subjectInput = document.getElementById('subject');
    
    // Set the service in select dropdown
    serviceSelect.value = serviceId;
    
    // Update subject
    subjectInput.value = `Service Request: ${serviceTitle}`;
    
    // Scroll to form
    document.querySelector('.service-request-form').scrollIntoView({ 
        behavior: 'smooth',
        block: 'center'
    });
    
    // Add visual feedback
    serviceSelect.style.borderColor = 'var(--color-primary)';
    serviceSelect.style.boxShadow = '0 0 0 3px rgba(var(--color-primary-rgb), 0.1)';
    
    // Remove highlight after 2 seconds
    setTimeout(() => {
        serviceSelect.style.borderColor = '';
        serviceSelect.style.boxShadow = '';
    }, 2000);
}
</script>
@endsection 