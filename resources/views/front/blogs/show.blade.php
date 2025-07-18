@extends('front.layouts.master')

@section('title', $blog->getTranslation('title', app()->getLocale()))

@section('content')
<!-- Blog Detail Header -->
<div class="rn-blog-detail-area rn-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Article Header -->
                <div class="blog-detail-header">
                    <div class="blog-meta">
                        <span class="blog-date">
                            <i data-feather="calendar"></i>
                            {{ $blog->published_at ? $blog->published_at->format('F d, Y') : __('Coming Soon') }}
                        </span>
                        <span class="blog-category">
                            <i data-feather="tag"></i>
                            {{__("Article")}}
                        </span>
                        <span class="blog-author">
                            <i data-feather="user"></i>
                            {{__("Admin")}}
                        </span>
                    </div>
                    
                    <h1 class="blog-title">{{ $blog->getTranslation('title', app()->getLocale()) }}</h1>
                    
                    <p class="blog-excerpt">
                        {{ $blog->getTranslation('main_description', app()->getLocale()) }}
                    </p>
                </div>

                <!-- Article Image -->
                @if($blog->main_image)
                <div class="blog-detail-image">
                    <img src="{{ asset('storage/' . $blog->main_image) }}" 
                         alt="{{ $blog->getTranslation('card_image_alt_text', app()->getLocale()) }}"
                         class="img-fluid">
                </div>
                @endif

                <!-- Article Content -->
                <div class="blog-detail-content">
                    {!! $blog->getTranslation('inner_description', app()->getLocale()) !!}
                </div>

                <!-- Article Footer -->
                <div class="blog-detail-footer">
                    <div class="blog-tags">
                        <span class="tags-label">{{__("Tags:")}}</span>
                        <span class="tag">{{__("Web Development")}}</span>
                        <span class="tag">{{__("Design")}}</span>
                        <span class="tag">{{__("Technology")}}</span>
                    </div>
                    
                    <div class="blog-share">
                        <span class="share-label">{{__("Share:")}}</span>
                        <a href="#" class="share-link" title="Facebook">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="#" class="share-link" title="Twitter">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="#" class="share-link" title="LinkedIn">
                            <i data-feather="linkedin"></i>
                        </a>
                        <a href="#" class="share-link" title="Copy Link">
                            <i data-feather="link"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Search Articles")}}</h4>
                        <form action="{{ route('blogs') }}" method="GET" class="sidebar-search">
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="{{__('Search...')}}">
                                <button class="btn btn-primary" type="submit">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Recent Articles Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Recent Articles")}}</h4>
                        <div class="recent-articles">
                            @forelse($recentBlogs as $recentBlog)
                            <div class="recent-article">
                                <div class="recent-article-image">
                                    @if($recentBlog->card_image)
                                        <img src="{{ asset('storage/' . $recentBlog->card_image) }}" 
                                             alt="{{ $recentBlog->getTranslation('card_image_alt_text', app()->getLocale()) }}">
                                    @else
                                        <div class="recent-placeholder">
                                            <i data-feather="image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="recent-article-content">
                                    <h5 class="recent-article-title">
                                        <a href="{{ route('blog.show', $recentBlog->getTranslation('slug', app()->getLocale())) }}">
                                            {{ $recentBlog->getTranslation('title', app()->getLocale()) }}
                                        </a>
                                    </h5>
                                    <span class="recent-article-date">
                                        {{ $recentBlog->published_at ? $recentBlog->published_at->format('M d, Y') : __('Coming Soon') }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <p class="no-recent">{{__("No recent articles")}}</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Categories")}}</h4>
                        <ul class="category-list">
                            <li><a href="#">{{__("Web Development")}} <span>(5)</span></a></li>
                            <li><a href="#">{{__("Design")}} <span>(3)</span></a></li>
                            <li><a href="#">{{__("Technology")}} <span>(7)</span></a></li>
                            <li><a href="#">{{__("Business")}} <span>(2)</span></a></li>
                            <li><a href="#">{{__("Marketing")}} <span>(4)</span></a></li>
                        </ul>
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Newsletter")}}</h4>
                        <p class="newsletter-text">{{__("Subscribe to our newsletter for the latest updates")}}</p>
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" 
                                       class="form-control" 
                                       placeholder="{{__('Your email')}}">
                                <button class="btn btn-primary" type="submit">
                                    <i data-feather="send"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Blog Detail Styles */
.blog-detail-header {
    margin-bottom: 40px;
}

.blog-detail-header .blog-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    font-size: 14px;
    color: var(--color-body);
}

.blog-detail-header .blog-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.blog-detail-header .blog-meta i {
    width: 16px;
    height: 16px;
}

.blog-detail-header .blog-title {
    font-size: 36px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 20px;
    color: var(--color-heading);
}

.blog-detail-header .blog-excerpt {
    font-size: 18px;
    line-height: 1.6;
    color: var(--color-body);
    margin-bottom: 0;
}

.blog-detail-image {
    margin-bottom: 40px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-1);
}

.blog-detail-image img {
    width: 100%;
    height: auto;
}

.blog-detail-content {
    margin-bottom: 40px;
    line-height: 1.8;
    color: var(--color-body);
}

.blog-detail-content h2,
.blog-detail-content h3,
.blog-detail-content h4 {
    color: var(--color-heading);
    margin-top: 30px;
    margin-bottom: 15px;
}

.blog-detail-content p {
    margin-bottom: 20px;
}

.blog-detail-content ul,
.blog-detail-content ol {
    margin-bottom: 20px;
    padding-left: 20px;
}

.blog-detail-content li {
    margin-bottom: 8px;
}

.blog-detail-content blockquote {
    background: var(--background-color-1);
    border-left: 4px solid var(--color-primary);
    padding: 20px;
    margin: 30px 0;
    border-radius: 8px;
    font-style: italic;
}

.blog-detail-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 0;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 40px;
}

.blog-tags {
    display: flex;
    align-items: center;
    gap: 10px;
}

.tags-label {
    font-weight: 600;
    color: var(--color-heading);
}

.tag {
    background: var(--background-color-1);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    color: var(--color-body);
}

.blog-share {
    display: flex;
    align-items: center;
    gap: 15px;
}

.share-label {
    font-weight: 600;
    color: var(--color-heading);
}

.share-link {
    width: 35px;
    height: 35px;
    background: var(--background-color-1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-body);
    text-decoration: none;
    transition: all 0.3s ease;
}

.share-link:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
}

.share-link i {
    width: 16px;
    height: 16px;
}

/* Sidebar Styles */
.blog-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: var(--background-color-1);
    padding: 25px;
    border-radius: 15px;
    box-shadow: var(--shadow-1);
    margin-bottom: 30px;
}

.widget-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--color-heading);
    position: relative;
    padding-bottom: 10px;
}

.widget-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--color-primary);
    border-radius: 2px;
}

.sidebar-search .input-group {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.sidebar-search .form-control {
    border: none;
    padding: 12px 15px;
    background: white;
}

.sidebar-search .btn {
    border: none;
    padding: 12px 15px;
    background: var(--color-primary);
    color: white;
}

.sidebar-search .btn:hover {
    background: var(--color-secondary);
}

/* Recent Articles */
.recent-articles {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.recent-article {
    display: flex;
    gap: 15px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
}

.recent-article:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.recent-article-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.recent-article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.recent-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
}

.recent-placeholder i {
    width: 24px;
    height: 24px;
}

.recent-article-content {
    flex: 1;
}

.recent-article-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.4;
}

.recent-article-title a {
    color: var(--color-heading);
    text-decoration: none;
    transition: color 0.3s ease;
}

.recent-article-title a:hover {
    color: var(--color-primary);
}

.recent-article-date {
    font-size: 12px;
    color: var(--color-body);
}

.no-recent {
    color: var(--color-body);
    font-style: italic;
    margin: 0;
}

/* Categories */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    margin-bottom: 10px;
}

.category-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--color-body);
    text-decoration: none;
    padding: 8px 0;
    transition: all 0.3s ease;
}

.category-list a:hover {
    color: var(--color-primary);
    transform: translateX(5px);
}

.category-list span {
    background: var(--background-color-2);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    color: var(--color-body);
}

/* Newsletter */
.newsletter-text {
    color: var(--color-body);
    margin-bottom: 20px;
    line-height: 1.6;
}

.newsletter-form .input-group {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.newsletter-form .form-control {
    border: none;
    padding: 12px 15px;
    background: white;
}

.newsletter-form .btn {
    border: none;
    padding: 12px 15px;
    background: var(--color-primary);
    color: white;
}

.newsletter-form .btn:hover {
    background: var(--color-secondary);
}

/* Responsive */
@media only screen and (max-width: 991px) {
    .blog-detail-header .blog-title {
        font-size: 28px;
    }
    
    .blog-detail-footer {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .blog-sidebar {
        position: static;
        margin-top: 40px;
    }
}

@media only screen and (max-width: 767px) {
    .blog-detail-header .blog-title {
        font-size: 24px;
    }
    
    .blog-detail-header .blog-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .blog-detail-content {
        font-size: 16px;
    }
    
    .sidebar-widget {
        padding: 20px;
    }
}
</style>
@endpush 