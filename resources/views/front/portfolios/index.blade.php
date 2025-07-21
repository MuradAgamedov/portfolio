@extends('front.layouts.master')

@section('title', __('seo_portfolio_title'))

@section('meta')
<meta name="description" content="{{ __('seo_portfolio_description') }}">
<meta name="keywords" content="{{ __('seo_portfolio_keywords') }}">
@endsection

@section('content')
<!-- Start Portfolio Area -->
<div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("my_projects_page_title_1")}}</span>
                    <h2 class="title">{{__("my_projects_page_title_2")}}</h2>
                </div>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portfolio-filter text-center mb-5 mt-5">
                    <div class="filter-buttons">
                        <a href="{{ localized_route('portfolios.index') }}" 
                           class="filter-btn {{ $selectedCategory == 'all' ? 'active' : '' }}">
                            {{__("All")}}
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ localized_route('portfolios.index', ['category' => $category->getSlug()]) }}" 
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
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 200) }}" data-aos-once="true" class="col-lg-4 col-md-6 col-12 mt--30">
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

/* Portfolio Service Card Styles */
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
@endsection 