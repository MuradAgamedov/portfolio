<!-- Start Single Service -->
<div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 200) }}" data-aos-once="true" class="col-lg-6 col-xl-4 col-md-6 col-sm-12 col-12 mt--50 mt_md--30 mt_sm--30">
    <div class="rn-service">
        <div class="inner">
            <div class="icon">
                <img src="{{asset('storage/'.$service->icon)}}" alt="{{$service->icon_alt}}">
            </div>
            <div class="content">
                <h4 class="title">
                    @if(isset($isServicesPage) && $isServicesPage)
                        <a href="#" class="service-link" data-service-id="{{ $service->id }}" data-service-title="{{ $service->getTitle() }}">{{ $service->getTitle() }}</a>
                    @else
                        <a href="#">{{ $service->getTitle() }}</a>
                    @endif
                </h4>
                <p class="description">{{ $service->getDescription() }}</p>
                @if(isset($isServicesPage) && $isServicesPage)
                    <a class="read-more-button service-link" href="#" data-service-id="{{ $service->id }}" data-service-title="{{ $service->getTitle() }}"><i class="feather-arrow-right"></i></a>
                @else
                    <a class="read-more-button" href="#"><i class="feather-arrow-right"></i></a>
                @endif
            </div>
        </div>
        @if(isset($isServicesPage) && $isServicesPage)
            <a class="over-link service-link" href="#" data-service-id="{{ $service->id }}" data-service-title="{{ $service->getTitle() }}"></a>
        @else
            <a class="over-link" href="#"></a>
        @endif
    </div>
</div>
<!-- End Single Service --> 