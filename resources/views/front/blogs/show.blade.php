@extends('front.layouts.master')

@section('title', $blog->getTranslation('title', app()->getLocale()))

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
           
                    
                    <div class="blog-share" style="display: flex !important; align-items: center !important; gap: 15px !important; flex-wrap: nowrap !important; flex-direction: row !important; margin-top: 20px !important;">
                        <span class="share-label" style="margin-right: 10px !important;">{{__("Share:")}}</span>
                        <a href="#" class="share-link" title="Facebook" style="display: inline-flex !important; margin: 0 5px !important; float: none !important;">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="#" class="share-link" title="Twitter" style="display: inline-flex !important; margin: 0 5px !important; float: none !important;">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="#" class="share-link" title="LinkedIn" style="display: inline-flex !important; margin: 0 5px !important; float: none !important;">
                            <i data-feather="linkedin"></i>
                        </a>
                        <a href="#" class="share-link" title="Copy Link" style="display: inline-flex !important; margin: 0 5px !important; float: none !important;">
                            <i data-feather="link"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
         

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
                                        <a href="{{ route('blog.show', $recentBlog->getSlug()) }}">
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



                    <!-- Newsletter Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">{{__("Newsletter")}}</h4>
                        <p class="newsletter-text">{{__("Subscribe to our newsletter for the latest updates")}}</p>
                        <form class="newsletter-form" id="newsletterForm" action="javascript:void(0);" method="POST" novalidate>
                            @csrf
                            <div class="input-group">
                                <input type="email" 
                                       name="email"
                                       class="form-control" 
                                       placeholder="{{__('Your email')}}">
                                <button class="btn btn-primary" type="button" id="newsletterSubmit">
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

<script>
console.log('Newsletter script loaded');



// Wait for page to load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    
    // Find the button
    const button = document.getElementById('newsletterSubmit');
    console.log('Button found:', button);
    
    if (button) {
        // Remove any existing event listeners
        button.removeEventListener('click', handleNewsletterSubmit);
        
        // Define the event handler function
        function handleNewsletterSubmit(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Button clicked!');
            
            // Prevent multiple clicks
            if (button.disabled) {
                console.log('Button is disabled, ignoring click');
                return;
            }
            
            // Get email
            const emailInput = document.querySelector('#newsletterForm input[name="email"]');
            const email = emailInput ? emailInput.value : '';
            console.log('Email:', email);
            
            // Simple validation
            if (!email || !email.includes('@')) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: 'Zəhmət olmasa düzgün email ünvanı daxil edin!'
                    });
                } else {
                    alert('Zəhmət olmasa düzgün email ünvanı daxil edin!');
                }
                return;
            }
            
            // Show loading
            button.disabled = true;
            button.style.opacity = '0.6';
            button.style.cursor = 'not-allowed';
            const originalText = button.innerHTML;
            button.innerHTML = '<i data-feather="loader"></i>';
            
            // Re-initialize feather icons for loader
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
            
            // Make AJAX request
            fetch('{{ route("newsletter") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    email: email,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                // Since we're sending Accept: application/json, Laravel should return JSON
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                if (data.success) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu!',
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        alert('Uğurlu! ' + data.message);
                    }
                    emailInput.value = '';
                } else {
                    // Handle error response
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta!',
                            text: data.message
                        });
                    } else {
                        alert('Xəta! ' + data.message);
                    }
                }
            })
            .catch(error => {
                console.log('Error:', error);
                let errorMessage = 'Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.';
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: errorMessage
                    });
                } else {
                    alert(errorMessage);
                }
            })
            .finally(() => {
                // Always re-enable button and restore original text
                console.log('Re-enabling button...');
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
                button.innerHTML = originalText;
                
                // Re-initialize feather icons if needed
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            });
        }
        
        // Add the new event listener
        button.addEventListener('click', handleNewsletterSubmit);
    }
    
    // Handle Enter key
    const emailInput = document.querySelector('#newsletterForm input[name="email"]');
    if (emailInput) {
        emailInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (!button.disabled) {
                    handleNewsletterSubmit(e);
                }
            }
        });
    }
});
</script>

<style>
/* Blog Detail Page Enhancements */
.blog-detail-header {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    padding: 40px;
    border-radius: 20px;
    margin-bottom: 40px;
    box-shadow: var(--shadow-1);
}

.blog-detail-header .blog-title {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 42px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
}

.blog-detail-header .blog-excerpt {
    font-size: 20px;
    line-height: 1.7;
    color: var(--color-body);
    margin-bottom: 0;
    font-weight: 400;
}

.blog-detail-image {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
    position: relative;
}

.blog-detail-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255, 1, 79, 0.1), rgba(209, 20, 20, 0.1));
    z-index: 1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.blog-detail-image:hover::before {
    opacity: 1;
}

.blog-detail-content {
    background: var(--background-color-1);
    padding: 40px;
    border-radius: 20px;
    box-shadow: var(--shadow-1);
    margin-bottom: 40px;
    line-height: 1.9;
    color: var(--color-body);
    font-size: 18px;
}

.blog-detail-content h2,
.blog-detail-content h3,
.blog-detail-content h4 {
    color: var(--color-heading);
    margin-top: 35px;
    margin-bottom: 20px;
    font-weight: 700;
    position: relative;
    padding-left: 20px;
}

.blog-detail-content h2::before,
.blog-detail-content h3::before,
.blog-detail-content h4::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 25px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 2px;
}

.blog-detail-content p {
    margin-bottom: 25px;
}

.blog-detail-content ul,
.blog-detail-content ol {
    margin-bottom: 25px;
    padding-left: 25px;
}

.blog-detail-content li {
    margin-bottom: 10px;
    position: relative;
}

.blog-detail-content ul li::before {
    content: '•';
    color: var(--color-primary);
    font-weight: bold;
    position: absolute;
    left: -20px;
}

.blog-detail-content blockquote {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-left: 5px solid var(--color-primary);
    padding: 30px;
    margin: 40px 0;
    border-radius: 15px;
    font-style: italic;
    font-size: 20px;
    position: relative;
    box-shadow: var(--shadow-1);
}

.blog-detail-content blockquote::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 60px;
    color: var(--color-primary);
    font-family: serif;
}

.blog-detail-footer {
    background: var(--background-color-1);
    padding: 30px;
    border-radius: 15px;
    box-shadow: var(--shadow-1);
    margin-bottom: 40px;
}

.blog-tags .tag {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 500;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.blog-tags .tag:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255, 1, 79, 0.3);
}

.share-link {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-left: 10px;
}

.share-link:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 8px 20px rgba(255, 1, 79, 0.3);
    color: white;
}

/* Sidebar Enhancements */
.sidebar-widget {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    padding: 30px;
    border-radius: 20px;
    box-shadow: var(--shadow-1);
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.widget-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    color: var(--color-heading);
    position: relative;
    padding-bottom: 15px;
}

.widget-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 2px;
}

.sidebar-search .input-group {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.sidebar-search .form-control {
    border: none;
    padding: 15px 20px;
    background: white;
    font-size: 16px;
}

.sidebar-search .btn {
    border: none;
    padding: 15px 20px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    font-weight: 600;
}

.sidebar-search .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 1, 79, 0.3);
}

.recent-article {
    background: rgba(255, 255, 255, 0.05);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.recent-article:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.recent-article-image {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.recent-article-title a {
    color: var(--color-heading);
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 600;
}

.recent-article-title a:hover {
    color: var(--color-primary);
}

.category-list a {
    background: rgba(255, 255, 255, 0.05);
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--color-body);
    text-decoration: none;
}

.category-list a:hover {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    transform: translateX(8px);
}

.category-list span {
    background: rgba(255, 255, 255, 0.1);
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.newsletter-form .input-group {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.newsletter-form .form-control {
    border: none;
    padding: 15px 20px;
    background: white;
    font-size: 16px;
}

.newsletter-form .btn {
    border: none;
    padding: 15px 20px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    font-weight: 600;
}

.newsletter-form .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 1, 79, 0.3);
}

/* Responsive */
@media only screen and (max-width: 991px) {
    .blog-detail-header .blog-title {
        font-size: 32px;
    }
    
    .blog-detail-content {
        padding: 30px;
        font-size: 16px;
    }
    
    .blog-sidebar {
        position: static;
        margin-top: 40px;
    }
}

@media only screen and (max-width: 767px) {
    .blog-detail-header {
        padding: 25px;
    }
    
    .blog-detail-header .blog-title {
        font-size: 26px;
    }
    
    .blog-detail-header .blog-excerpt {
        font-size: 18px;
    }
    
    .blog-detail-content {
        padding: 25px;
        font-size: 16px;
    }
    
    .sidebar-widget {
        padding: 25px;
    }
}
</style>
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
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 30px !important;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 40px;
    background: var(--background-color-1);
    border-radius: 15px;
    box-shadow: var(--shadow-1);
    flex-wrap: wrap !important;
    gap: 20px !important;
    flex-direction: row !important;
    width: 100% !important;
}

.blog-tags {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    flex-wrap: wrap !important;
    flex-direction: row !important;
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
    display: flex !important;
    align-items: center !important;
    gap: 15px !important;
    flex-wrap: nowrap !important;
    flex-direction: row !important;
    margin-top: 20px !important;
}

.share-label {
    font-weight: 600;
    color: var(--color-heading);
    white-space: nowrap;
    margin-right: 10px !important;
}

.share-link {
    width: 40px !important;
    height: 40px !important;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary)) !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    margin: 0 5px !important;
    flex-shrink: 0 !important;
    float: none !important;
    position: relative !important;
}

.share-link:hover {
    transform: translateY(-3px) scale(1.1) !important;
    box-shadow: 0 8px 20px rgba(255, 1, 79, 0.3) !important;
    color: white !important;
}

.share-link i {
    width: 18px !important;
    height: 18px !important;
    display: block !important;
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
    display: flex;
    align-items: stretch;
}
.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    margin-left: 0px !important;

}
.newsletter-form .form-control {
    border: none;
    padding: 12px 15px;
    background: white;
    height: auto;
}

.newsletter-form .btn {
    border: none;
    padding: 12px 15px;
    background: var(--color-primary);
    color: white;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
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