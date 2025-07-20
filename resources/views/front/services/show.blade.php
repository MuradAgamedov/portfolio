@extends('front.layouts.master')

@section('title', $service->getTitle())

@section('content')
<!-- Start Service Detail Area -->
<div class="rn-service-detail-area rn-section-gap section-separator" id="service-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title">
                    <div class="title-column">
                        <span class="subtitle">{{__("Service Details")}}</span>
                        <h2 class="title">{{ $service->getTitle() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt--50">
            <div class="col-lg-8">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="200" data-aos-once="true" class="service-detail-content">
                    <div class="service-header">
                        <div class="service-icon">
                            @if($service->getIconUrl())
                                <img src="{{ $service->getIconUrl() }}" alt="{{ $service->getIconAltText() }}">
                            @else
                                <i class="fas fa-cogs"></i>
                            @endif
                        </div>
                        <div class="service-info">
                            <h3 class="service-title">{{ $service->getTitle() }}</h3>
                            <p class="service-description">{{ $service->getDescription() }}</p>
                        </div>
                    </div>

                    <div class="service-body">
                        <div class="service-description-full">
                            {!! nl2br(e($service->getDescription())) !!}
                        </div>
                    </div>

                    <!-- Service Request Form -->
                    <div class="service-request-section mt-5">
                        <div class="request-form-header">
                            <h4>{{__('Request This Service')}}</h4>
                            <p>{{__('Interested in this service? Send us your request and we\'ll get back to you soon.')}}</p>
                        </div>
                        
                        <form class="service-request-form" id="serviceRequestForm">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="service_select">{{__('Service')}} *</label>
                                        <select id="service_select" name="service_id" class="form-control" required>
                                            <option value="{{ $service->id }}" selected>{{ $service->getTitle() }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="subject">{{__('Subject')}} *</label>
                                        <input type="text" id="subject" name="subject" class="form-control" value="Service Request: {{ $service->getTitle() }}" required>
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

            <div class="col-lg-4">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-once="true" class="service-sidebar">
                    <!-- Other Services -->
                    <div class="other-services">
                        <h4>{{__('Other Services')}}</h4>
                        <div class="services-list">
                            @foreach($services as $otherService)
                                <div class="service-item">
                                    <a href="{{ route('services.show', $otherService->getSlug()) }}" class="service-link">
                                        <div class="service-icon-small">
                                            @if($otherService->getIconUrl())
                                                <img src="{{ $otherService->getIconUrl() }}" alt="{{ $otherService->getIconAltText() }}">
                                            @else
                                                <i class="fas fa-cogs"></i>
                                            @endif
                                        </div>
                                        <div class="service-info-small">
                                            <h5>{{ $otherService->getTitle() }}</h5>
                                            <p>{{ Str::limit($otherService->getDescription(), 80) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Back to Services -->
                    <div class="back-to-services mt-4">
                        <a href="{{ route('services.index') }}" class="btn btn-outline">
                            <i data-feather="arrow-left"></i>
                            <span>{{__('Back to All Services')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Service Detail Area -->
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

/* Service Detail Content */
.service-detail-content {
    background: var(--background-color-1);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.service-header {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.service-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.service-icon i {
    font-size: 32px;
    color: white;
}

.service-info {
    flex: 1;
}

.service-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 15px;
}

.service-description {
    color: var(--color-body);
    line-height: 1.6;
    margin: 0;
}

.service-body {
    margin-bottom: 30px;
}

.service-description-full {
    color: var(--color-body);
    line-height: 1.8;
    font-size: 16px;
}

/* Service Request Form */
.service-request-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
    border-radius: 15px;
    padding: 30px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.request-form-header {
    text-align: center;
    margin-bottom: 25px;
}

.request-form-header h4 {
    font-size: 24px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 10px;
}

.request-form-header p {
    color: var(--color-body);
    margin: 0;
}

.service-request-form .form-group {
    margin-bottom: 20px;
}

.service-request-form label {
    display: block;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 8px;
    font-size: 14px;
}

.service-request-form .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--color-heading);
    font-size: 14px;
    backdrop-filter: blur(6px);
    transition: all 0.3s ease;
}

.service-request-form .form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.1);
}

.service-request-form textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.form-actions {
    text-align: center;
    margin-top: 25px;
}

.btn-primary {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border: none;
    border-radius: 10px;
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
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(var(--color-primary-rgb), 0.4);
}

.btn-primary i {
    width: 16px;
    height: 16px;
}

/* Service Sidebar */
.service-sidebar {
    position: sticky;
    top: 20px;
}

.other-services {
    background: var(--background-color-1);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.other-services h4 {
    font-size: 20px;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 20px;
}

.services-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.service-item {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.service-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.service-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.service-link:hover {
    background: rgba(255, 255, 255, 0.1);
    text-decoration: none;
}

.service-icon-small {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.service-icon-small img {
    width: 20px;
    height: 20px;
    object-fit: contain;
}

.service-icon-small i {
    font-size: 16px;
    color: white;
}

.service-info-small {
    flex: 1;
}

.service-info-small h5 {
    font-size: 14px;
    font-weight: 600;
    color: var(--color-heading);
    margin: 0 0 5px 0;
}

.service-info-small p {
    font-size: 12px;
    color: var(--color-body);
    margin: 0;
    line-height: 1.4;
}

.back-to-services {
    text-align: center;
}

.btn-outline {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 12px 20px;
    color: var(--color-body);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    color: var(--color-heading);
    text-decoration: none;
}

.btn-outline i {
    width: 16px;
    height: 16px;
}

/* Responsive */
@media only screen and (max-width: 991px) {
    .service-sidebar {
        position: static;
        margin-top: 30px;
    }
}

@media only screen and (max-width: 767px) {
    .section-title .title-column {
        text-align: center;
        align-items: center;
        gap: 10px;
    }
    
    .section-title .title {
        font-size: 36px;
    }
    
    .service-detail-content {
        padding: 25px;
    }
    
    .service-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .service-title {
        font-size: 24px;
    }
}

@media only screen and (max-width: 575px) {
    .section-title .title {
        font-size: 28px;
    }
    
    .service-detail-content {
        padding: 20px;
    }
    
    .service-request-section {
        padding: 20px;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission (for now, just prevent default)
    document.getElementById('serviceRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Form submission logic will be added later
        console.log('Service request form submitted');
    });
});
</script>
@endsection 