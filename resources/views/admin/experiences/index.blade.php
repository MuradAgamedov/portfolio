@extends('admin.layouts.master')

@section('title', 'Təcrübələr')

@section('styles')
<style>
.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.status-active {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-inactive {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.reorder-handle {
    cursor: move;
    color: #6c757d;
}

.reorder-handle:hover {
    color: #495057;
}

.ongoing-badge {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-briefcase"></i> Təcrübələr
                </h1>
                <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Yeni Təcrübə
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Təcrübə Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($experiences->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="experiencesTable">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="50">Sıra</th>
                                <th>Pozisiya</th>
                                <th>Şirkət</th>
                                <th>Tarix</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortableExperiences">
                            @foreach($experiences as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <i class="fas fa-grip-vertical reorder-handle"></i>
                                        <span class="ms-2">{{ $item->order }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $item->getTitle() }}</div>
                                        <small class="text-muted">{{ Str::limit($item->getDescription(), 100) }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $item->getCompanyName() }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $item->getFormattedStartDate() }}</div>
                                        @if($item->isOngoing())
                                            <span class="ongoing-badge">Davam edir</span>
                                        @else
                                            <div class="text-muted">{{ $item->getFormattedEndDate() }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status)
                                            <span class="status-badge status-active">Aktiv</span>
                                        @else
                                            <span class="status-badge status-inactive">Deaktiv</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.experiences.edit', $item) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Redaktə et">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.experiences.destroy', $item) }}" 
                                                  method="POST" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Bu təcrübəni silmək istədiyinizə əminsiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Sil">
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
                <div class="text-center py-4">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Hələ heç bir təcrübə əlavə edilməyib</h5>
                    <p class="text-muted">İlk təcrübəni əlavə etmək üçün "Yeni Təcrübə" düyməsinə basın</p>
                    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Təcrübə
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Sortable
    var sortable = Sortable.create(document.getElementById('sortableExperiences'), {
        handle: '.reorder-handle',
        animation: 150,
        onEnd: function(evt) {
            var items = [];
            $('#sortableExperiences tr').each(function(index) {
                items.push({
                    id: $(this).data('id'),
                    order: index + 1
                });
            });

            // Update order numbers in the table
            $('#sortableExperiences tr').each(function(index) {
                $(this).find('td:eq(1) span:last').text(index + 1);
            });

            // Send reorder request
            $.ajax({
                url: '{{ route("admin.experiences.reorder") }}',
                method: 'POST',
                data: {
                    orders: items,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                       
                        
                        // Auto-hide after 3 seconds
                        setTimeout(function() {
                            alert.alert('close');
                        }, 3000);
                    }
                },
                error: function() {
                    alert('Sıralama yenilənərkən xəta baş verdi!');
                }
            });
        }
    });
});
</script>
@endsection 