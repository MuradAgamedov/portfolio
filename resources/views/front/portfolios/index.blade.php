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

        <div class="row mt--30">
            @foreach($portfolios as $index => $portfolio)
            <!-- Start Single Portfolio -->
            <div class="col-lg-4 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 50) }}" data-aos-once="true">
                <div class="portfolio-card">
                    <div class="inner">
                        <div class="thumbnail">
                            <a href="{{ $portfolio->project_link ?? '#' }}" target="_blank">
                                <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}" 
                                     alt="{{ $portfolio->getTitle() }}">
                            </a>
                        </div>
                        <div class="content">
                            <div style="margin-top: 10px;" class="portfolio-info">
                                <a href="{{ $portfolio->project_link ?? '#' }}" target="_blank">
                                    {{ $portfolio->getTitle() }}
                                </a>
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

@push('styles')
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
}

.pagination {
    gap: 8px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: fit-content;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    border: none;
    background: rgba(255, 255, 255, 0.1);
    color: var(--color-body);
    border-radius: 12px;
    padding: 14px 18px;
    min-width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-decoration: none;
}

.pagination .page-link:hover {
    background: rgba(255, 255, 255, 0.2);
    color: var(--color-heading);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.pagination .page-item.active .page-link {
    background: var(--color-primary);
    color: white;
    box-shadow: 0 8px 25px rgba(var(--color-primary-rgb), 0.4);
    border-color: var(--color-primary);
}

.pagination .page-item.disabled .page-link {
    background: rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.3);
    cursor: not-allowed;
    border-color: rgba(255, 255, 255, 0.05);
}

.pagination .page-link i {
    width: 20px;
    height: 20px;
    stroke-width: 2.5px;
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

/* Portfolio Card Styles */
.portfolio-card {
    background: linear-gradient(135deg, #212428 0%, #1d1f23 100%);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 4px solid #ff014f;
    transition: all 0.4s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
    margin: 10px;
    outline: 2px solid rgba(255, 1, 79, 0.3);
    outline-offset: 3px;
}

.portfolio-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 1, 79, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.portfolio-card:hover::before {
    opacity: 1;
}

.portfolio-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    border-color: #ff014f;
    border-width: 5px;
    outline-color: rgba(255, 1, 79, 0.6);
    outline-width: 3px;
}

.portfolio-card .thumbnail {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.portfolio-card .thumbnail img {
    transition: transform 0.4s ease;
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.portfolio-card:hover .thumbnail img {
    transform: scale(1.1);
}

.portfolio-card .content {
    padding: 0;
    position: relative;
    z-index: 2;
}

.portfolio-card .portfolio-info {
    text-align: center;
}

.portfolio-card .portfolio-info a {
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    text-decoration: none;
    transition: color 0.3s ease;
    display: block;
    margin-bottom: 6px;
}

.portfolio-card .portfolio-info a:hover {
    color: var(--color-primary);
}

.portfolio-card .company {
    font-size: 13px;
    color: #c4cfde;
    margin: 0;
    font-weight: 400;
}

.portfolio-card .company a {
    color: #c4cfde;
    text-decoration: none;
    transition: color 0.3s ease;
}

.portfolio-card .company a:hover {
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
@endpush 