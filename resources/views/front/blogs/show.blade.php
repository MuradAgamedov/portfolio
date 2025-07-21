@extends('front.layouts.master')

@section('title', $blog->getTitle())

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($blog->getMainDescription()), 160) }}">
<meta name="keywords" content="{{ $blog->getTitle() }}, {{ $blog->category ? $blog->category->getTitle() : '' }}, blog, article">
<meta property="og:title" content="{{ $blog->getTitle() }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($blog->getMainDescription()), 160) }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ request()->url() }}">
@if($blog->getMainImageUrl())
<meta property="og:image" content="{{ asset($blog->getMainImageUrl()) }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->getTitle() }}">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($blog->getMainDescription()), 160) }}">
@if($blog->getMainImageUrl())
<meta name="twitter:image" content="{{ asset($blog->getMainImageUrl()) }}">
@endif
@endsection

@section('content')
<!-- Start Blog Detail Area -->
<div class="rn-blog-details-area rn-section-gap section-separator">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blog Content -->
                <div class="blog-details-content">
                    <!-- Blog Header -->
                    <div class="blog-header mb-4">
                        <h1 class="blog-title">{{ $blog->getTitle() }}</h1>
                        <div class="blog-meta">
                            <span class="meta-item">
                                <i data-feather="calendar"></i>
                                {{ $blog->getFormattedPublishedDate() }}
                            </span>
                            @if($blog->category)
                                <span class="meta-item">
                                    <i data-feather="folder"></i>
                                    {{ $blog->category->getTitle() }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Blog Image -->
                    @if($blog->getMainImageUrl())
                        <div class="blog-image mb-4">
                            <img src="{{ $blog->getMainImageUrl() }}" 
                                 alt="{{ $blog->getMainImageAltText() }}" 
                                 class="img-fluid rounded">
                        </div>
                    @endif

                    <!-- Blog Description -->
                    <div class="blog-description">
                        {!! $blog->getMainDescription() !!}
                    </div>

                    <!-- Social Share -->
                    <div class="social-share mt-5">
                        <h5>{{__("Share this post")}}</h5>
                        <div class="share-buttons">
                            <!-- Facebook Share -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="share-btn facebook-share"
                               title="{{__('Share on Facebook')}}">
                                <i class="fab fa-facebook-f"></i>
                                <span>{{__('Facebook')}}</span>
                            </a>

                            <!-- Twitter Share -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->getTitle()) }}" 
                               target="_blank" 
                               class="share-btn twitter-share"
                               title="{{__('Share on Twitter')}}">
                                <i class="fab fa-twitter"></i>
                                <span>{{__('Twitter')}}</span>
                            </a>

                            <!-- LinkedIn Share -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="share-btn linkedin-share"
                               title="{{__('Share on LinkedIn')}}">
                                <i class="fab fa-linkedin-in"></i>
                                <span>{{__('LinkedIn')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Recent Posts -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Recent Posts")}}</h4>
                        <div class="recent-posts">
                            @foreach($recentBlogs as $recentBlog)
                                <div class="recent-post-item">
                                    <div class="post-thumbnail">
                                        <a href="{{ localized_route('blog.show', [$recentBlog->id, $recentBlog->getSlug()]) }}" title="{{ $recentBlog->getTitle() }}">
                                            <img src="{{ $recentBlog->getCardImageUrl() ?: 'assets/images/blog/blog-01.jpg' }}" 
                                                 alt="{{ $recentBlog->getCardImageAltText() }}">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title">
                                            <a href="{{ localized_route('blog.show', [$recentBlog->id, $recentBlog->getSlug()]) }}" title="{{ $recentBlog->getTitle() }}">
                                                {{ Str::limit($recentBlog->getTitle(), 50) }}
                                            </a>
                                        </h6>
                                        <span class="post-date">{{ $recentBlog->getFormattedPublishedDate() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Blog Detail Area -->
@endsection

@section('styles')
<style>
/* Blog Detail Styles */
.blog-details-content {
    background: var(--background-color-1);
    border-radius: 15px;
    padding: 40px;
    box-shadow: var(--shadow-1);
}

.blog-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--color-heading);
    margin-bottom: 20px;
    line-height: 1.2;
}

.blog-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--color-body);
    font-size: 14px;
}

.meta-item i {
    width: 16px;
    height: 16px;
}

.blog-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.blog-description {
    font-size: 16px;
    line-height: 1.8;
    color: var(--color-body);
}

.blog-description h2, .blog-description h3, .blog-description h4 {
    color: var(--color-heading);
    margin-top: 30px;
    margin-bottom: 15px;
}

.blog-description p {
    margin-bottom: 20px;
}

.blog-description img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
}

/* Social Share Styles */
.social-share {
    border-top: 1px solid #e9ecef;
    padding-top: 30px;
}

.social-share h5 {
    margin-bottom: 20px;
    color: var(--color-heading);
    font-weight: 600;
}

.share-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.share-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.share-btn:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.facebook-share {
    background: #1877f2;
}

.facebook-share:hover {
    background: #166fe5;
    box-shadow: 0 5px 15px rgba(24, 119, 242, 0.4);
}

.twitter-share {
    background: #1da1f2;
}

.twitter-share:hover {
    background: #1a91da;
    box-shadow: 0 5px 15px rgba(29, 161, 242, 0.4);
}

.linkedin-share {
    background: #0077b5;
}

.linkedin-share:hover {
    background: #006097;
    box-shadow: 0 5px 15px rgba(0, 119, 181, 0.4);
}

.share-btn i {
    font-size: 16px;
}

/* Sidebar Styles */
.blog-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: var(--background-color-1);
    border-radius: 15px;
    padding: 30px;
    box-shadow: var(--shadow-1);
    margin-bottom: 30px;
}

.widget-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--color-primary);
}

.recent-posts {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.recent-post-item {
    display: flex;
    gap: 15px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.recent-post-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.post-thumbnail {
    flex-shrink: 0;
    width: 80px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
}

.post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-content {
    flex: 1;
}

.post-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    line-height: 1.4;
}

.post-title a {
    color: var(--color-heading);
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: var(--color-primary);
}

.post-date {
    font-size: 12px;
    color: var(--color-body);
}

/* Responsive */
@media only screen and (max-width: 991px) {
    .blog-details-content {
        padding: 30px;
    }
    
    .blog-title {
        font-size: 2rem;
    }
    
    .blog-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .share-buttons {
        justify-content: center;
    }
    
    .blog-sidebar {
        margin-top: 40px;
    }
}

@media only screen and (max-width: 767px) {
    .blog-details-content {
        padding: 20px;
    }
    
    .blog-title {
        font-size: 1.8rem;
    }
    
    .share-buttons {
        flex-direction: column;
    }
    
    .share-btn {
        justify-content: center;
    }
    
    .sidebar-widget {
        padding: 20px;
    }
}

@media only screen and (max-width: 575px) {
    .blog-title {
        font-size: 1.5rem;
    }
    
    .blog-description {
        font-size: 15px;
    }
}
</style>
@endsection 