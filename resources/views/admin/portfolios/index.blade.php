@extends('admin.layouts.master')

@section('title', 'Portfolio')

@section('styles')
<style>
.portfolio-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #e9ecef;
}

.drag-handle {
    cursor: grab;
    text-align: center;
}

.drag-handle:active {
    cursor: grabbing;
}

.sortable-ghost {
    opacity: 0.5;
    background: #f8f9fa !important;
}

.sortable-chosen {
    background: #e3f2fd !important;
}

.sortable-drag {
    background: white !important;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

#sortablePortfolios tr {
    transition: all 0.2s ease;
}

#sortablePortfolios tr:hover {
    background-color: #f8f9fa;
}

.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.company-info {
    font-size: 0.875rem;
    color: #6c757d;
}

.project-links {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.project-links a {
    font-size: 0.75rem;
    padding: 2px 6px;
    border-radius: 4px;
    text-decoration: none;
}

.project-links .company-link {
    background-color: #e3f2fd;
    color: #1976d2;
}

.project-links .project-link {
    background-color: #f3e5f5;
    color: #7b1fa2;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-briefcase"></i> Portfolio
            </h1>
            <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Portfolio
            </a>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.portfolios.index') }}" class="d-flex">
                <select name="category_id" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">Bütün Kateqoriyalar</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->getTitle() }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Portfolio Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($portfolios->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                <th width="80">Şəkil</th>
                                <th>Başlıq</th>
                                <th>Kateqoriya</th>
                                <th>Şirkət</th>
                                <th>Linklər</th>
                                <th>Sıra</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortablePortfolios">
                            @foreach($portfolios as $portfolio)
                            <tr data-id="{{ $portfolio->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                <td>
                                    @if($portfolio->image)
                                        <img src="{{ $portfolio->getImageUrl() }}" 
                                             alt="{{ $portfolio->getTitle() }}" 
                                             class="portfolio-image">
                                    @else
                                        <div class="portfolio-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $portfolio->getTitle() }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($portfolio->getDescription(), 100) }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($portfolio->category)
                                        <span class="badge bg-info">{{ $portfolio->category->title['az'] ?? $portfolio->category->title['en'] ?? $portfolio->category->title['ru'] ?? 'Unnamed Category' }}</span>
                                    @else
                                        <span class="badge bg-secondary">Kateqoriya yoxdur</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="company-info">
                                        <strong>{{ $portfolio->company_name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="project-links">
                                        @if($portfolio->company_website)
                                            <a href="{{ $portfolio->company_website }}" 
                                               target="_blank" 
                                               class="company-link" 
                                               title="Şirkət saytı">
                                                <i class="fas fa-external-link-alt"></i> Şirkət
                                            </a>
                                        @endif
                                        @if($portfolio->project_link)
                                            <a href="{{ $portfolio->project_link }}" 
                                               target="_blank" 
                                               class="project-link" 
                                               title="Layihə linki">
                                                <i class="fas fa-external-link-alt"></i> Layihə
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $portfolio->order }}</td>
                                <td>
                                    @if($portfolio->status)
                                        <span class="badge bg-success status-badge">Aktiv</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.portfolios.edit', $portfolio) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bu portfolio-nu silmək istədiyinizə əminsiniz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-briefcase"></i>
                    <h5>Hələ portfolio əlavə edilməyib</h5>
                    <p>Yeni portfolio əlavə etmək üçün yuxarıdakı düyməni istifadə edin</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Sortable.js -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Sortable
    var sortablePortfolios = document.getElementById('sortablePortfolios');
    if (sortablePortfolios) {
        new Sortable(sortablePortfolios, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortablePortfolios tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.portfolios.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortablePortfolios tr').each(function(index) {
                            $(this).find('td:eq(5)').text(index);
                        });
                    },
                    error: function(xhr) {
                        alert('Sıralama yenilənərkən xəta baş verdi!');
                    }
                });
            }
        });
    }
});
</script>
@endsection 