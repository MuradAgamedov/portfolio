@extends('front.layouts.master')

@section('title', 'Portfolio')

@section('content')
<!-- Start Portfolio Area -->
<div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("my projects")}}</span>
                    <h2 class="title">{{__("my projects")}}</h2>
                </div>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portfolio-filter text-center mb-5">
                    <div class="filter-buttons">
                        <a href="{{ route('portfolios.index') }}" 
                           class="filter-btn {{ $selectedCategory == 'all' ? 'active' : '' }}">
                            {{__("All")}}
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('portfolios.index', ['category' => $category->getSlug()]) }}" 
                               class="filter-btn {{ $selectedCategory == $category->getSlug() ? 'active' : '' }}">
                                {{ $category->getTitle() }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row row--25 mt--30 mt_md--10 mt_sm--10">
            @foreach($portfolios as $index => $portfolio)
            <!-- Start Single Portfolio -->
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 200) }}" data-aos-once="true" class="col-lg-6 col-xl-4 col-md-6 col-sm-12 col-12 mt--50 mt_md--30 mt_sm--30">
                <div class="rn-service">
                    <div class="inner">
                        <div class="">
                            <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}" 
                                 alt="{{ $portfolio->getTitle() }}">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ $portfolio->project_link ?? '#' }}" target="_blank">{{ $portfolio->getTitle() }}</a>
                            </h4>
                            @if($portfolio->company_name)
                            <p class="description">
                                <a href="{{ $portfolio->company_website ?? '#' }}" target="_blank">
                                    {{ $portfolio->company_name }}
                                </a>
                            </p>
                            @endif
                            <a class="read-more-button" href="{{ $portfolio->project_link ?? '#' }}" target="_blank">
                                <i class="feather-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <a class="over-link" href="{{ $portfolio->project_link ?? '#' }}" target="_blank"></a>
                </div>
            </div>
            <!-- End Single Portfolio -->
            @endforeach
        </div>

        <!-- Custom Pagination -->
        @if($portfolios->hasPages())
        <div class="row mt-5">
            <div class="col-12 text-center">
                <nav aria-label="Portfolio pagination" class="pagination-container">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($portfolios->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i data-feather="chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $portfolios->appends(request()->query())->previousPageUrl() }}" rel="prev">
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($portfolios->getUrlRange(1, $portfolios->lastPage()) as $page => $url)
                            @if ($page == $portfolios->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $portfolios->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($portfolios->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $portfolios->appends(request()->query())->nextPageUrl() }}" rel="next">
                                    <i data-feather="chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i data-feather="chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- End Portfolio Area -->
@endsection

@section('styles')
<style>
/* CSS Variables */
:root {
    --color-primary: #ff014f;
    --color-primary-rgb: 255, 1, 79;
    --color-body: #c4cfde;
    --color-heading: #ffffff;
    --background-color-1: #212428;
    --background-color-2: #1d1f23;
    --shadow-1: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Pagination Styles */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 40px;
}

.pagination {
    gap: 8px;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    background: #2a2d31;
    color: #c4cfde;
    border: none;
    border-radius: 12px;
    padding: 12px 16px;
    min-width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.pagination .page-link:hover {
    background: #3a3d41;
    color: #ffffff;
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background: #ff014f;
    color: white;
    font-weight: bold;
}

.pagination .page-item.disabled .page-link {
    background: #2a2d31;
    color: #6c757d;
    cursor: not-allowed;
}

.pagination .page-link svg {
    width: 18px;
    height: 18px;
    stroke-width: 2.5px;
}

/* Previous button - D shape on left side */
.pagination .page-item:first-child .page-link {
    border-radius: 22px 12px 12px 22px;
    padding-left: 18px;
    padding-right: 14px;
}

/* Next button - D shape on right side */
.pagination .page-item:last-child .page-link {
    border-radius: 12px 22px 22px 12px;
    padding-left: 14px;
    padding-right: 18px;
}

/* Portfolio Filter Styles */
.portfolio-filter {
    margin-bottom: 40px;
}

.filter-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

.filter-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--color-body);
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.filter-btn:hover {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
    transform: translateY(-2px);
}

.filter-btn.active {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}

/* Portfolio Service Card Customization */
.rn-service .icon {
    padding: 0;
    margin: 0;
}



.rn-service:hover .icon img {
    transform: scale(1.1);
}

.rn-service .description a {
    color: var(--color-body);
    text-decoration: none;
    transition: color 0.3s ease;
}

.rn-service .description a:hover {
    color: var(--color-primary);
}

/* Additional Card Styling */
.portfolio-card {
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.3),
        0 0 0 4px #ff014f,
        0 0 0 8px rgba(255, 1, 79, 0.2);
}

.portfolio-card:hover {
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.4),
        0 0 0 6px #ff014f,
        0 0 0 12px rgba(255, 1, 79, 0.3);
}

/* Card background with pattern */
.portfolio-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 30%, rgba(255, 1, 79, 0.05) 50%, transparent 70%);
    pointer-events: none;
    border-radius: 20px;
}

/* Pagination Styles */
.pagination-wrapper .pagination {
    justify-content: center;
}

.pagination-wrapper .page-link {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--color-body);
    margin: 0 5px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}

.pagination-wrapper .page-item.active .page-link {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .filter-buttons {
        gap: 10px;
    }
    
    .filter-btn {
        padding: 8px 16px;
        font-size: 13px;
    }
}
</style>
@endsection 