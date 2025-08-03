<div class="col-lg-4 col-md-6 col-sm-12 pricing-card-wrapper" data-index="{{ $index }}">
    <div class="pricing-card {{ $index == 1 ? 'pricing-card-hover' : '' }}">
        <div class="pricing-card-header">
            <div class="pricing-badge">{{ $index == 1 ? 'Popular' : ($index == 0 ? 'Basic' : ($index == 2 ? 'Premium' : 'Enterprise')) }}</div>
            <div class="pricing-price">
                {!! $plan->getTranslation('price', app()->getLocale()) !!}
            </div>
            <h3 class="pricing-title">{{ $plan->getTranslation('title', app()->getLocale()) }}</h3>
        </div>

        <div class="pricing-card-body">
            <div class="pricing-features">
                @foreach($plan->activeFeatures as $feature)
                <div class="feature-item">
                    <div class="feature-icon">
                        <i data-feather="check"></i>
                    </div>
                    <span class="feature-text">{{ $feature->getTranslation('title', app()->getLocale()) }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="pricing-card-footer">
            <a href="#" class="rn-btn d-block pricing-get-started-btn" data-plan="{{ $plan->getTranslation('title', app()->getLocale()) }}">
                <span>{{__("Get Started")}}</span>
                <i data-feather="arrow-right"></i>
            </a>
        </div>
    </div>
</div> 