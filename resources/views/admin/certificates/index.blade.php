@extends('admin.layouts.master')

@section('title', 'Sertifikatlar')

@section('styles')
<style>
.certificate-image {
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

#sortableCertificates tr {
    transition: all 0.2s ease;
}

#sortableCertificates tr:hover {
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

.issue-date {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 500;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-certificate"></i> Sertifikatlar
            </h1>
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Sertifikat
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sertifikat Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($certificates->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                <th width="80">Şəkil</th>
                                <th>Başlıq</th>
                                <th>Təsvir</th>
                                <th>Verilə Tarixi</th>
                                <th>Sıra</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortableCertificates">
                            @foreach($certificates as $certificate)
                            <tr data-id="{{ $certificate->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                <td>
                                    @if($certificate->image)
                                        <img src="{{ $certificate->getImageUrl() }}" 
                                             alt="{{ $certificate->getImageAltText() }}" 
                                             class="certificate-image">
                                    @else
                                        <div class="certificate-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $certificate->getTitle() }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small class="text-muted">{{ Str::limit($certificate->getDescription(), 100) }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="issue-date">
                                        {{ $certificate->getFormattedIssueDate() }}
                                    </div>
                                </td>
                                <td>{{ $certificate->order }}</td>
                                <td>
                                    @if($certificate->status)
                                        <span class="badge bg-success status-badge">Aktiv</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.certificates.edit', $certificate) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bu sertifikatı silmək istədiyinizə əminsiniz?')">
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
                    <i class="fas fa-certificate"></i>
                    <h5>Hələ sertifikat əlavə edilməyib</h5>
                    <p>Yeni sertifikat əlavə etmək üçün yuxarıdakı düyməni istifadə edin</p>
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
    var sortableCertificates = document.getElementById('sortableCertificates');
    if (sortableCertificates) {
        new Sortable(sortableCertificates, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortableCertificates tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.certificates.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortableCertificates tr').each(function(index) {
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