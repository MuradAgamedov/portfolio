@extends('front.layouts.master')

@section('title', __('seo_blogs_title'))

@section('meta')
<meta name="description" content="{{ __('seo_blogs_description') }}">
<meta name="keywords" content="{{ __('seo_blogs_keywords') }}">
@endsection

@section('content')
<!-- Start Blog Area -->
<div class="rn-blog-area rn-section-gap section-separator" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title">
                    <div class="title-column">
                        <span class="subtitle">{{__("Welcome to the space where I share my thoughts")}}</span>
                        <h2 class="title">{{__("My Blog")}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
<div class="search-filter-section mb-5">
    <div class="search-filter-container">
        <form action="{{ localized_route('blogs.index') }}" method="GET" class="search-filter-form">
            <div class="search-box">
                <div class="search-input-wrapper">
                    <i class="search-icon" data-feather="search"></i>
                    <input type="text" 
                           name="search" 
                           class="search-input" 
                           placeholder="{{__('Search blogs...')}}"
                           value="{{ request('search') }}">
                    @if(request('search'))
                        <button type="button" class="clear-search" onclick="clearSearch()">
                            <i data-feather="x"></i>
                        </button>
                    @endif
                </div>
                <button type="submit" class="search-btn">
                    <i data-feather="search"></i>
                    <span>{{__('Search')}}</span>
                </button>
            </div>

            <div class="filter-section">
                <div class="filter-label">
                    <i data-feather="filter"></i>
                    <span>{{__('Filter by Category')}}</span>
                </div>
                <div class="category-filters">
                    <a href="{{ localized_route('blogs.index', array_merge(request()->query(), ['category' => ''])) }}" 
                       class="category-filter {{ !request('category') ? 'active' : '' }}">
                        <i data-feather="grid"></i>
                        <span>{{__('All Categories')}}</span>
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ localized_route('blogs.index', array_merge(request()->query(), ['category' => $category->getSlug()])) }}" 
                           class="category-filter {{ request('category') == $category->getSlug() ? 'active' : '' }}">
                            <i data-feather="folder"></i>
                            <span>{{ $category->getTitle() }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>


        <div class="row row--25 mt--30 mt_md--10 mt_sm--10" style="align-items: stretch;">
            @forelse($blogs as $index => $blog)
            <!-- Start Single blog -->
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 50) }}" data-aos-once="true" class="col-lg-6 col-xl-4 mt--30 col-md-6 col-sm-12 col-12 mt--30" style="display: flex;">
                <div class="rn-blog">
                    <div class="inner">
                        <div class="thumbnail">
                            <a href="{{ localized_route('blog.show', [$blog->id, $blog->getSlug()]) }}">
                                <img src="{{ $blog->getCardImageUrl() ?: 'assets/images/blog/blog-01.jpg' }}" alt="{{ $blog->getCardImageAltText() }}">
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ localized_route('blog.show', [$blog->id, $blog->getSlug()]) }}">
                                    {{ Str::limit($blog->getTitle(), 60) }}
                                    <i class="feather-arrow-up-right"></i>
                                </a>
                            </h4>
                            <div class="meta">
                                <span><i class="feather-clock"></i> {{ $blog->getFormattedPublishedDate() }}</span>
                                @if($blog->category)
                                    <span><i class="feather-folder"></i> {{ $blog->category->getTitle() }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single blog -->
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i data-feather="info"></i>
                    {{__('No blogs found.')}}
                </div>
            </div>
            @endforelse
        </div>

        <!-- Custom Pagination -->
        @if($blogs->hasPages())
        <div class="row mt-5">
            <div class="col-12 text-center">
                <nav aria-label="Blog pagination" class="pagination-container">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i data-feather="chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">
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
</div> <!-- End Blog Area -->
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

/* Responsive for title column */
@media only screen and (max-width: 767px) {
    .section-title .title-column {
        text-align: center;
        align-items: center;
        gap: 10px;
    }
    
    .section-title .title {
        font-size: 36px;
    }
}

@media only screen and (max-width: 575px) {
    .section-title .title {
        font-size: 28px;
    }
}

/* Blog Card Styles */
.rn-blog {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border-radius: 15px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.rn-blog:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.rn-blog .inner {
    background: var(--background-color-1);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.rn-blog:hover .inner {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.rn-blog .thumbnail {
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
    width: 100% !important;
    height: 220px !important;
    max-height: 220px !important;
    min-height: 220px !important;
    background: #f8f9fa;
}

.rn-blog .thumbnail img {
    transition: transform 0.4s ease;
    width: 100% !important;
    height: 220px !important;
    object-fit: cover !important;
    object-position: center !important;
    max-width: 100% !important;
    min-width: 100% !important;
    max-height: 220px !important;
    min-height: 220px !important;
}

.rn-blog:hover .thumbnail img {
    transform: scale(1.1);
}

.rn-blog .content {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex: 1;
    min-height: 120px;
}

.rn-blog .title {
    font-size: 18px;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 15px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.rn-blog .meta {
    font-size: 14px;
    color: var(--color-body);
    margin-top: auto;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.rn-blog .meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.rn-blog .meta i {
    width: 16px;
    height: 16px;
}

.rn-blog .title a {
    color: var(--color-heading);
    text-decoration: none;
    transition: color 0.3s ease;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    word-wrap: break-word;
}

.rn-blog .title a:hover {
    color: var(--color-primary);
}

.rn-blog .title a i {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
    flex-shrink: 0;
    margin-top: 2px;
}

.rn-blog:hover .title a i {
    transform: translateX(5px) translateY(-5px);
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

/* Modern Search and Filter Styles */
.search-filter-section {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 20px;
    padding: 30px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.search-filter-container {
    max-width: 100%;
}

.search-filter-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}
.search-box {
    display: flex;
    gap: 15px;
    align-items: center;
}

.search-input-wrapper {
    position: relative;
    flex: 1;
    min-width: 250px;
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-body);
}

.search-input {
    width: 100%;
    padding: 12px 45px 12px 45px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.15);
    color: var(--color-heading);
    font-size: 15px;
    backdrop-filter: blur(6px);
    transition: 0.3s;
}

.search-input::placeholder {
    color: var(--color-body);
}

.search-btn {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(var(--color-primary-rgb), 0.3);
    transition: all 0.3s ease;
    width: 150px;
    justify-content: center;
    flex-shrink: 0;
}

.search-btn:hover {
    transform: translateY(-2px);
}

.clear-search {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-body);
    cursor: pointer;
}

.filter-section {
    margin-top: 25px;
}

.filter-label {
    font-size: 15px;
    color: var(--color-heading);
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.category-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.category-filter {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.03);
    border-radius: 10px;
    color: var(--color-body);
    font-size: 14px;
    transition: all 0.2s ease;
    text-decoration: none;
    backdrop-filter: blur(8px);
}

.category-filter:hover {
    background: rgba(255, 255, 255, 0.08);
    color: var(--color-heading);
    border-color: var(--color-primary);
}

.category-filter.active {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
    box-shadow: 0 4px 10px rgba(var(--color-primary-rgb), 0.3);
}


.category-filter i {
    width: 16px;
    height: 16px;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .rn-blog .content {
        padding: 20px;
        min-height: 100px;
    }
    
    .rn-blog .title {
        font-size: 16px;
        -webkit-line-clamp: 2;
    }
    
    .rn-blog .thumbnail {
        height: 180px !important;
        max-height: 180px !important;
        min-height: 180px !important;
    }
    
    .rn-blog .thumbnail img {
        height: 180px !important;
        max-height: 180px !important;
        min-height: 180px !important;
    }
}

@media only screen and (max-width: 575px) {
    .rn-blog .title {
        font-size: 15px;
        -webkit-line-clamp: 2;
    }
    
    .rn-blog .content {
        padding: 15px;
    }
    
    .rn-blog .thumbnail {
        height: 160px !important;
        max-height: 160px !important;
        min-height: 160px !important;
    }
    
    .rn-blog .thumbnail img {
        height: 160px !important;
        max-height: 160px !important;
        min-height: 160px !important;
    }
}

/* Responsive Search and Filter */
@media only screen and (max-width: 991px) {
    .search-box {
        flex-direction: column;
    }
    
    .search-btn {
        justify-content: center;
    }
    
    .category-filters {
        justify-content: center;
    }
}

@media only screen and (max-width: 767px) {
    .search-filter-section {
        padding: 20px;
    }
    
    .category-filter {
        padding: 10px 15px;
        font-size: 14px;
    }
}

@media only screen and (max-width: 575px) {
    .search-filter-section {
        padding: 15px;
    }
    
    .search-input {
        padding: 12px 40px 12px 40px;
        font-size: 14px;
    }
    
    .search-btn {
        padding: 12px 20px;
        font-size: 14px;
    }
    
    .category-filters {
        gap: 8px;
    }
    
    .category-filter {
        padding: 8px 12px;
        font-size: 13px;
    }
}
</style>

@section('scripts')
<script>
function clearSearch() {
    const input = document.querySelector('.search-input');
    input.value = '';
    const url = new URL(window.location);
    url.searchParams.delete('search');
    window.location.href = url.toString();
}
// Auto-submit form when Enter is pressed
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    }
});
</script>
@endsection 