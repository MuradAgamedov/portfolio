@extends('admin.layouts.master')

@section('title', 'Xidmətlər')

@section('styles')
<style>
.service-icon {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
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

#sortableServices tr {
    transition: all 0.2s ease;
}

#sortableServices tr:hover {
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-cogs"></i> Xidmətlər
            </h1>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Xidmət
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xidmət Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($services->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                <th width="50">İkon</th>
                                <th>Başlıq</th>
                                <th>Sıra</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortableServices">
                            @foreach($services as $service)
                            <tr data-id="{{ $service->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                <td>
                                    <div class="service-icon">
                                        @if($service->icon)
                                            <img src="{{ $service->getIconUrl() }}" 
                                                 alt="{{ $service->getIconAltText() }}" 
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $service->getTitle() }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($service->getDescription(), 100) }}</small>
                                    </div>
                                </td>
                                <td>{{ $service->order }}</td>
                                <td>
                                    @if($service->status)
                                        <span class="badge bg-success status-badge">Aktiv</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.services.edit', $service) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bu xidməti silmək istədiyinizə əminsiniz?')">
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
                    <i class="fas fa-cogs"></i>
                    <h5>Hələ xidmət əlavə edilməyib</h5>
                    <p>Yeni xidmət əlavə etmək üçün yuxarıdakı düyməni istifadə edin</p>
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
    var sortableServices = document.getElementById('sortableServices');
    if (sortableServices) {
        new Sortable(sortableServices, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortableServices tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.services.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortableServices tr').each(function(index) {
                            $(this).find('td:eq(3)').text(index);
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