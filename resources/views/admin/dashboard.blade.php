@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <h1 class="h3 mb-0">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </h1>
                <p class="text-muted">Xoş gəlmisiniz! Bu ayın statistikaları</p>
            </div>
        </div>
    </div>

    <!-- Main Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-primary">
                <div class="stat-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalServices }}</h3>
                    <p>Xidmətlər</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> {{ $monthlyServices }} bu ay
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-success">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalPortfolios }}</h3>
                    <p>Portfolio</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> {{ $monthlyPortfolios }} bu ay
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-info">
                <div class="stat-icon">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalBlogs }}</h3>
                    <p>Blog</p>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> {{ $monthlyBlogs }} bu ay
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-warning">
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalContacts }}</h3>
                    <p>Mesajlar</p>
                    <small class="text-danger">
                        <i class="fas fa-exclamation-circle"></i> {{ $unreadContacts }} oxunmamış
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-secondary">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalEducation }}</h3>
                    <p>Təhsil</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-dark">
                <div class="stat-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalSkills }}</h3>
                    <p>Bacariqlar</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-danger">
                <div class="stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalCertificates }}</h3>
                    <p>Sertifikatlar</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-light">
                <div class="stat-icon text-dark">
                    <i class="fas fa-language"></i>
                </div>
                <div class="stat-content text-dark">
                    <h3>{{ $totalLanguages }}</h3>
                    <p>Dillər</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Data -->
    <div class="row">
        <!-- Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Son 6 ayın statistikaları</h6>
                </div>
                <div class="card-body">
                    <canvas id="statsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Sürətli Əməliyyatlar</h6>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm mb-2 w-100">
                            <i class="fas fa-plus"></i> Yeni Xidmət
                        </a>
                        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-success btn-sm mb-2 w-100">
                            <i class="fas fa-plus"></i> Yeni Portfolio
                        </a>
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-info btn-sm mb-2 w-100">
                            <i class="fas fa-plus"></i> Yeni Blog
                        </a>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-warning btn-sm mb-2 w-100">
                            <i class="fas fa-envelope"></i> Mesajları Bax
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="row">
        <!-- Recent Services -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Son Xidmətlər</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Status</th>
                                    <th>Tarix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentServices as $service)
                                <tr>
                                    <td>{{ $service->getTitle() }}</td>
                                    <td>
                                        @if($service->status)
                                            <span class="badge bg-success">Aktiv</span>
                                        @else
                                            <span class="badge bg-secondary">Deaktiv</span>
                                        @endif
                                    </td>
                                    <td>{{ $service->created_at->format('d.m.Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Son Mesajlar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Status</th>
                                    <th>Tarix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentContacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge bg-success">Oxunub</span>
                                        @else
                                            <span class="badge bg-warning">Oxunmayıb</span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->created_at->format('d.m.Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.welcome-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 20px;
}

.stat-card {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.stat-card.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.stat-card.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.stat-card.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

.stat-card.bg-dark {
    background: linear-gradient(135deg, #343a40 0%, #212529 100%);
}

.stat-card.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
}

.stat-card.bg-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.stat-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 2.5rem;
    opacity: 0.3;
}

.stat-content h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-content p {
    font-size: 1rem;
    margin-bottom: 5px;
    opacity: 0.9;
}

.stat-content small {
    font-size: 0.8rem;
    opacity: 0.8;
}

.quick-actions .btn {
    border-radius: 8px;
    font-weight: 500;
}

.table-sm th {
    font-weight: 600;
    font-size: 0.9rem;
}

.table-sm td {
    font-size: 0.85rem;
}

.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('statsChart').getContext('2d');
    
    const chartData = @json($chartData);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(item => item.month),
            datasets: [{
                label: 'Xidmətlər',
                data: chartData.map(item => item.services),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }, {
                label: 'Portfolio',
                data: chartData.map(item => item.portfolios),
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4
            }, {
                label: 'Blog',
                data: chartData.map(item => item.blogs),
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                tension: 0.4
            }, {
                label: 'Mesajlar',
                data: chartData.map(item => item.contacts),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection 