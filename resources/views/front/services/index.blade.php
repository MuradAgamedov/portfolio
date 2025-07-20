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
                                    <div class="select-wrapper">
                                        <select id="service_select" name="service_id" class="form-control custom-select" required>
                                            <option value="" disabled selected>{{__('Choose a service...')}}</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" data-title="{{ $service->getTitle() }}" data-description="{{ $service->getDescription() }}">
                                                    {{ $service->getTitle() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="select-arrow">
                                            <i data-feather="chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="selected-service-info" class="selected-service-info" style="display: none;">
                                        <div class="service-info-card">
                                            <div class="service-info-icon">
                                                <img id="selected-service-icon" src="" alt="">
                                            </div>
                                            <div class="service-info-content">
                                                <h5 id="selected-service-title"></h5>
                                                <p id="selected-service-description"></p>
                                            </div>
                                        </div>
                                    </div>
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
    position: relative;
    z-index: 5;
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

/* Custom Select Styles */
.select-wrapper {
    position: relative;
    z-index: 20;
}

.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    padding-right: 50px;
    z-index: 10;
    position: relative;
}

.custom-select option {
    background: var(--background-color-1);
    color: black;
    padding: 12px 20px;
    border: none;
    font-size: 14px;
}

.custom-select option:hover {
    background: var(--color-primary);
    color: white;
}

.custom-select option:checked {
    background: var(--color-primary);
    color: white;
}

.select-arrow {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    transition: transform 0.3s ease;
}

.custom-select:focus + .select-arrow {
    transform: translateY(-50%) rotate(180deg);
}

.select-arrow i {
    width: 20px;
    height: 20px;
    color: var(--color-body);
    transition: color 0.3s ease;
}

.custom-select:focus ~ .select-arrow i {
    color: var(--color-primary);
}

/* Selected Service Info Styles */
.selected-service-info {
    margin-top: 15px;
    animation: fadeInUp 0.3s ease;
}

.service-info-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    backdrop-filter: blur(10px);
}

.service-info-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.service-info-icon img {
    width: 25px;
    height: 25px;
    object-fit: contain;
}

.service-info-content h5 {
    color: var(--color-heading);
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 5px 0;
}

.service-info-content p {
    color: var(--color-body);
    font-size: 14px;
    margin: 0;
    line-height: 1.4;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-actions {
    text-align: center;
    margin-top: 30px;
}

.btn-primary {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border: none;
    border-radius: 12px;
    padding: 12px 25px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(var(--color-primary-rgb), 0.3);
    transition: all 0.3s ease;
    width: auto;
    min-width: 150px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(var(--color-primary-rgb), 0.4);
}

.btn-primary i {
    width: 16px;
    height: 16px;
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
    const selectedServiceInfo = document.getElementById('selected-service-info');
    const selectedServiceIcon = document.getElementById('selected-service-icon');
    const selectedServiceTitle = document.getElementById('selected-service-title');
    const selectedServiceDescription = document.getElementById('selected-service-description');
    
    // Update subject and show service info when service is selected
    serviceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const serviceTitle = selectedOption.getAttribute('data-title');
            const serviceDescription = selectedOption.getAttribute('data-description');
            
            // Update subject
            subjectInput.value = `Service Request: ${serviceTitle}`;
            
            // Show service info card
            selectedServiceTitle.textContent = serviceTitle;
            selectedServiceDescription.textContent = serviceDescription;
            
            // Get service icon from the service cards
            const serviceCards = document.querySelectorAll('.rn-service');
            serviceCards.forEach(card => {
                const cardTitle = card.querySelector('.title a').textContent.trim();
                if (cardTitle === serviceTitle) {
                    const iconImg = card.querySelector('.icon img');
                    if (iconImg) {
                        selectedServiceIcon.src = iconImg.src;
                        selectedServiceIcon.alt = iconImg.alt;
                    }
                }
            });
            
            selectedServiceInfo.style.display = 'block';
            
            // Add visual feedback to select
            this.style.borderColor = 'var(--color-primary)';
            this.style.boxShadow = '0 0 0 3px rgba(var(--color-primary-rgb), 0.1)';
        } else {
            subjectInput.value = '';
            selectedServiceInfo.style.display = 'none';
            this.style.borderColor = '';
            this.style.boxShadow = '';
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
    const selectedServiceInfo = document.getElementById('selected-service-info');
    const selectedServiceIcon = document.getElementById('selected-service-icon');
    const selectedServiceTitle = document.getElementById('selected-service-title');
    const selectedServiceDescription = document.getElementById('selected-service-description');
    
    // Set the service in select dropdown
    serviceSelect.value = serviceId;
    
    // Trigger change event to update form
    const event = new Event('change');
    serviceSelect.dispatchEvent(event);
    
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