<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Murad Portfolio</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 0;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        
        .sidebar .nav-link.disabled {
            color: rgba(255,255,255,0.4) !important;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        .sidebar .nav-link.disabled:hover {
            background: none !important;
            transform: none !important;
        }
        
        .sidebar .nav-link .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
        
        .nav-group-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 5px;
        }
        
        .nav-group {
            border-left: 2px solid rgba(255,255,255,0.1);
            padding-left: 10px;
            margin-left: 5px;
        }
        
        .nav-group:last-child {
            border-left: none;
            padding-left: 0;
            margin-left: 0;
        }
        
        .nav-link.dropdown-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .nav-link.dropdown-toggle .fa-chevron-down {
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }
        
        .nav-link.dropdown-toggle[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }
        
        /* Hide Bootstrap's default dropdown icon */
        .nav-link.dropdown-toggle::after {
            display: none !important;
        }
        
        .nav-submenu {
            padding-left: 20px;
            border-left: 2px solid rgba(255,255,255,0.1);
            margin-left: 10px;
        }
        
        .nav-submenu .nav-link {
            font-size: 0.9rem;
            padding: 8px 15px;
            margin: 2px 0;
        }
        
        .collapse {
            transition: all 0.3s ease;
        }
        
        .collapse.show {
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
            margin: 5px 0;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4><i class="fas fa-user-tie"></i> Admin Panel</h4>
                        <hr>
                    </div>
                    
                    <nav class="nav flex-column">
                        <!-- Dashboard -->
                        <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>

                        <!-- Content Management -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#contentManagement" role="button">
                                <i class="fas fa-file-alt"></i> Kontent İdarəetməsi
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/hero*') || request()->is('admin/about*') ? 'show' : '' }}" id="contentManagement">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/hero/edit*') ? 'active' : '' }}" href="{{ route('admin.hero.edit') }}">
                                        <i class="fas fa-home"></i> Hero Bölməsi
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/hero-professions*') ? 'active' : '' }}" href="{{ route('admin.hero-professions.index') }}">
                                        <i class="fas fa-briefcase"></i> Hero Peşələr
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/about*') ? 'active' : '' }}" href="{{ route('admin.about.edit') }}">
                                        <i class="fas fa-user"></i> Haqqımda
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Portfolio & Services -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#portfolioServices" role="button">
                                <i class="fas fa-briefcase"></i> Portfolio & Xidmətlər
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/services*') || request()->is('admin/portfolio*') || request()->is('admin/certificates*') ? 'show' : '' }}" id="portfolioServices">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                                        <i class="fas fa-cogs"></i> Xidmətlər
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/portfolio-categories*') ? 'active' : '' }}" href="{{ route('admin.portfolio-categories.index') }}">
                                        <i class="fas fa-tags"></i> Portfolio Kateqoriyaları
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/portfolios*') ? 'active' : '' }}" href="{{ route('admin.portfolios.index') }}">
                                        <i class="fas fa-briefcase"></i> Portfolio
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/certificates*') ? 'active' : '' }}" href="{{ route('admin.certificates.index') }}">
                                        <i class="fas fa-certificate"></i> Sertifikatlar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Resume -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#resume" role="button">
                                <i class="fas fa-file-text"></i> CV & Təcrübə
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/education*') || request()->is('admin/skills*') || request()->is('admin/experiences*') ? 'show' : '' }}" id="resume">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/education*') ? 'active' : '' }}" href="{{ route('admin.education.index') }}">
                                        <i class="fas fa-graduation-cap"></i> Təhsil
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/skills*') ? 'active' : '' }}" href="{{ route('admin.skills.index') }}">
                                        <i class="fas fa-chart-bar"></i> Bacarıqlar
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/experiences*') ? 'active' : '' }}" href="{{ route('admin.experiences.index') }}">
                                        <i class="fas fa-briefcase"></i> Təcrübələr
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog & Content -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#blogContent" role="button">
                                <i class="fas fa-blog"></i> Blog & Kontent
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/blogs*') || request()->is('admin/blog-categories*') || request()->is('admin/pricing-plans*') ? 'show' : '' }}" id="blogContent">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/blog-categories*') ? 'active' : '' }}" href="{{ route('admin.blog-categories.index') }}">
                                        <i class="fas fa-tags"></i> Blog Kateqoriyaları
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/blogs*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                                        <i class="fas fa-blog"></i> Blog
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/pricing-plans*') ? 'active' : '' }}" href="{{ route('admin.pricing-plans.index') }}">
                                        <i class="fas fa-dollar-sign"></i> Qiymət Planları
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Communication -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#communication" role="button">
                                <i class="fas fa-comments"></i> Əlaqə & Mesajlar
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/socials*') || request()->is('admin/contacts*') || request()->is('admin/newsletters*') ? 'show' : '' }}" id="communication">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/socials*') ? 'active' : '' }}" href="{{ route('admin.socials.edit') }}">
                                        <i class="fas fa-share-alt"></i> Sosial Şəbəkələr
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                                        <i class="fas fa-envelope"></i> Əlaqə Mesajları
                                        @php
                                            $unreadCount = \App\Models\Contact::unread()->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="badge bg-warning text-dark ms-2">{{ $unreadCount }}</span>
                                        @endif
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/newsletters*') ? 'active' : '' }}" href="{{ route('admin.newsletters.index') }}">
                                        <i class="fas fa-envelope"></i> Newsletter
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Settings -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#settings" role="button">
                                <i class="fas fa-cog"></i> Tənzimləmələr
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse {{ request()->is('admin/languages*') || request()->is('admin/dictionary*') || request()->is('admin/site-settings*') || request()->is('admin/seo-site*') ? 'show' : '' }}" id="settings">
                                <div class="nav-submenu">
                                    <a class="nav-link {{ request()->is('admin/languages*') ? 'active' : '' }}" href="{{ route('admin.languages.index') }}">
                                        <i class="fas fa-language"></i> Dillər
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/dictionary*') ? 'active' : '' }}" href="{{ route('admin.dictionary.index') }}">
                                        <i class="fas fa-book"></i> Tərcümə Sözlüyü
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/site-settings*') ? 'active' : '' }}" href="{{ route('admin.site-settings.index') }}">
                                        <i class="fas fa-cogs"></i> Sayt Tənzimləmələri
                                    </a>
                                    <a class="nav-link {{ request()->is('admin/seo-site*') ? 'active' : '' }}" href="{{ route('admin.seo-site.index') }}">
                                        <i class="fas fa-search"></i> SEO Tənzimləmələri
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <div class="main-content">
                    <!-- Header -->
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="navbar-nav ms-auto">
                                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-sign-out-alt"></i> Çıxış
                                    </button>
                                </form>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Page Content -->
                    <div class="p-4">
                    
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html> 