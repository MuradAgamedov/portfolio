@extends('front.layouts.master')

@section('title', __('Blog'))

@section('content')
<!-- Blog Header -->
<div class="rn-blog-area rn-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Blog")}}</span>
                    <h2 class="title">{{__("Latest Articles")}}</h2>
                    <p class="description">{{__("Discover insights, tips, and stories from our latest blog posts")}}</p>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb--50">
            <div class="col-lg-8 mx-auto">
                <div class="blog-search-wrapper">
                    <form action="{{ route('blogs') }}" method="GET" class="blog-search-form">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="{{__('Search articles...')}}"
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row">
            @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-sm-12 mb--30">
                <div class="blog-card">
                    <div class="blog-card-image">
                        @if($blog->card_image)
                            <img src="{{ asset('storage/' . $blog->card_image) }}" 
                                 alt="{{ $blog->getTranslation('card_image_alt_text', app()->getLocale()) }}"
                                 class="img-fluid">
                        @else
                            <div class="blog-placeholder">
                                <i data-feather="image"></i>
                            </div>
                        @endif
                        <div class="blog-card-overlay">
                            <a href="{{ route('blog.show', $blog->getTranslation('slug', app()->getLocale())) }}" 
                               class="read-more-btn">
                                <i data-feather="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="blog-card-content">
                        <div class="blog-meta">
                            <span class="blog-date">
                                <i data-feather="calendar"></i>
                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : __('Coming Soon') }}
                            </span>
                            <span class="blog-category">
                                <i data-feather="tag"></i>
                                {{__("Article")}}
                            </span>
                        </div>
                        
                        <h3 class="blog-title">
                            <a href="{{ route('blog.show', $blog->getTranslation('slug', app()->getLocale())) }}">
                                {{ $blog->getTranslation('title', app()->getLocale()) }}
                            </a>
                        </h3>
                        
                        <p class="blog-excerpt">
                            {{ Str::limit(strip_tags($blog->getTranslation('main_description', app()->getLocale())), 120) }}
                        </p>
                        
                        <div class="blog-footer">
                            <a href="{{ route('blog.show', $blog->getTranslation('slug', app()->getLocale())) }}" 
                               class="read-more">
                                {{__("Read More")}}
                                <i data-feather="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="no-blogs-found text-center">
                    <i data-feather="file-text" class="no-blogs-icon"></i>
                    <h3>{{__("No Articles Found")}}</h3>
                    <p>{{__("We couldn't find any articles matching your search criteria.")}}</p>
                    <a href="{{ route('blogs') }}" class="btn btn-primary">
                        {{__("View All Articles")}}
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
        <div class="row">
            <div class="col-12">
                <div class="pagination-wrapper text-center">
                    {{ $blogs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
/* Blog Search Styles */
.blog-search-wrapper {
    background: var(--background-color-1);
    padding: 30px;
    border-radius: 15px;
    box-shadow: var(--shadow-1);
}

.blog-search-form .input-group {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.blog-search-form .form-control {
    border: none;
    padding: 15px 20px;
    font-size: 16px;
    background: white;
}

.blog-search-form .btn {
    border: none;
    padding: 15px 25px;
    background: var(--color-primary);
    color: white;
    transition: all 0.3s ease;
}

.blog-search-form .btn:hover {
    background: var(--color-secondary);
    transform: translateY(-2px);
}

/* Blog Card Styles */
.blog-card {
    background: var(--background-color-1);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-1);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.blog-card-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.blog-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card:hover .blog-card-image img {
    transform: scale(1.1);
}

.blog-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
}

.blog-placeholder i {
    width: 48px;
    height: 48px;
}

.blog-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.blog-card:hover .blog-card-overlay {
    opacity: 1;
}

.read-more-btn {
    width: 50px;
    height: 50px;
    background: var(--color-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    background: var(--color-secondary);
    transform: scale(1.1);
    color: white;
}

.blog-card-content {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 14px;
    color: var(--color-body);
}

.blog-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.blog-meta i {
    width: 16px;
    height: 16px;
}

.blog-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    line-height: 1.4;
}

.blog-title a {
    color: var(--color-heading);
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-title a:hover {
    color: var(--color-primary);
}

.blog-excerpt {
    color: var(--color-body);
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
}

.blog-footer {
    margin-top: auto;
}

.read-more {
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: var(--color-secondary);
    transform: translateX(5px);
}

.read-more i {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(3px);
}

/* No Blogs Found */
.no-blogs-found {
    padding: 60px 20px;
}

.no-blogs-icon {
    width: 80px;
    height: 80px;
    color: var(--color-body);
    margin-bottom: 20px;
}

.no-blogs-found h3 {
    color: var(--color-heading);
    margin-bottom: 15px;
}

.no-blogs-found p {
    color: var(--color-body);
    margin-bottom: 30px;
}

/* Pagination Styles */
.pagination-wrapper {
    margin-top: 50px;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.page-link {
    border: none;
    background: var(--background-color-1);
    color: var(--color-heading);
    padding: 12px 18px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-1);
}

.page-link:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: var(--color-primary);
    color: white;
}

.page-item.disabled .page-link {
    background: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .blog-search-wrapper {
        padding: 20px;
    }
    
    .blog-card-content {
        padding: 20px;
    }
    
    .blog-title {
        font-size: 18px;
    }
    
    .blog-meta {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endpush 