@extends('front.layouts.master')

@section('title', __('Blogs'))

@section('content')
<!-- Start Blog Area -->
<div class="rn-blog-area rn-section-gap section-separator" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title text-center">
                    <span class="subtitle">{{__("Visit my blog and keep your feedback")}}</span>
                    <h2 class="title">{{__("My Blog")}}</h2>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-5">
            <div class="col-lg-8">
                <form action="{{ route('blogs.index') }}" method="GET" class="d-flex">
                    <input type="text" 
                           name="search" 
                           class="form-control me-3" 
                           placeholder="{{__('Search blogs...')}}"
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="search"></i>
                    </button>
                </form>
            </div>
            <div class="col-lg-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">{{__('All Categories')}}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->getSlug() }}" {{ request('category') == $category->getSlug() ? 'selected' : '' }}>
                            {{ $category->getTitle() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row row--25 mt--30 mt_md--10 mt_sm--10" style="align-items: stretch;">
            @forelse($blogs as $index => $blog)
            <!-- Start Single blog -->
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 100 + ($index * 50) }}" data-aos-once="true" class="col-lg-6 col-xl-4 mt--30 col-md-6 col-sm-12 col-12 mt--30" style="display: flex;">
                <div class="rn-blog">
                    <div class="inner">
                        <div class="thumbnail">
                            <a href="{{ route('blog.show', $blog->getSlug()) }}">
                                <img src="{{ $blog->getCardImageUrl() ?: 'assets/images/blog/blog-01.jpg' }}" alt="{{ $blog->getCardImageAltText() }}">
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ route('blog.show', $blog->getSlug()) }}">
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
            <div class="col-12">
                <nav aria-label="Blog pagination">
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
.pagination {
    gap: 5px;
}

.pagination .page-link {
    border: none;
    background: var(--background-color-1);
    color: var(--color-heading);
    border-radius: 8px;
    padding: 12px 16px;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-1);
}

.pagination .page-link:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: var(--color-primary);
    color: white;
}

.pagination .page-item.disabled .page-link {
    background: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
}

/* Search and Filter Styles */
.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--color-primary-rgb), 0.25);
}

.btn-primary {
    background: var(--color-primary);
    border: none;
    border-radius: 10px;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
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
</style>
@endsection 