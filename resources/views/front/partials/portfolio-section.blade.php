<!-- Start Portfolio Area -->
<div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="width: 100%;" class="section-title d-flex justify-content-between align-items-center flex-wrap" data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true">
                    <div class="title-column">
                        <span class="subtitle">{{__("my projects")}}</span>
                        <h2 class="title">{{__("my projects")}}</h2>
                    </div>
                    <div class="view-all-btn ms-auto">
                        <a href="{{ localized_route('portfolios.index') }}" class="rn-btn">
                            <span>{{__("View All")}}</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Portfolio Items -->
        <div class="row">
            @foreach($portfolios as $portfolio)
            <div class="col-lg-4 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 200 + ($loop->index * 100) }}" data-aos-once="true">
                <div class="rn-service">
                    <div class="inner">
                        <div class="">
                            <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}" 
                                 alt="{{ $portfolio->getTitle() }}">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ localized_route('portfolios.index') }}#portfolio-{{ $portfolio->id }}">{{ $portfolio->getTitle() }}</a>
                            </h4>
                            @if($portfolio->company_name)
                                <p class="company">
                                    <a href="{{ $portfolio->company_website ?? '#' }}" target="_blank">
                                        {{ $portfolio->company_name }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>
</div>
<!-- End Portfolio Area -->

@push('styles')
<style>


.rn-service {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.rn-service:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.rn-service img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.rn-service:hover img {
    transform: scale(1.05);
}

.rn-service .content {
    text-align: center;
}

.rn-service .title {
    font-size: 18px;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 10px;
}

.rn-service .title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.rn-service .title a:hover {
    color: var(--color-primary);
}

.rn-service .company {
    font-size: 13px;
    color: var(--color-body);
    margin: 0;
    font-weight: 400;
}

.rn-service .company a {
    color: var(--color-body);
    text-decoration: none;
    transition: color 0.3s ease;
}

.rn-service .company a:hover {
    color: var(--color-primary);
}

.rn-service .category {
    margin-top: 10px;
}

.rn-service .badge {
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 15px;
}

/* View All Button */
.rn-btn {
    display: inline-block;
    padding: 15px 30px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.rn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .rn-service {
        padding: 20px;
    }
}

@media only screen and (max-width: 575px) {
    .rn-service {
        padding: 15px;
    }
}
</style>
@endpush

 