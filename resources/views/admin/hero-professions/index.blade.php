@extends('admin.layouts.master')

@section('title', 'Hero Peşələr')

@section('styles')
<style>
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

#sortableProfessions tr {
    transition: all 0.2s ease;
}

#sortableProfessions tr:hover {
    background-color: #f8f9fa;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-briefcase"></i> Hero Peşələr
            </h1>
            <a href="{{ route('admin.hero-professions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Peşə Əlavə Et
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peşələr Siyahısı</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="professionsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="50"><i class="fas fa-grip-vertical"></i></th>
                            <th>ID</th>
                            <th>Peşə Adı</th>
                            <th>Sıra</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                    </thead>
                    <tbody id="sortableProfessions">
                        @foreach($professions as $profession)
                        @php
                            $firstLanguage = $languages->first();
                            $mainTitle = $firstLanguage ? $profession->getTranslation('title', $firstLanguage->lang_code, false) : 'Başlıq yoxdur';
                            // Debug info
                            // echo "Profession ID: " . $profession->id . "<br>";
                            // echo "Raw title: " . $profession->getRawOriginal('title') . "<br>";
                            // echo "First language: " . $firstLanguage->lang_code . "<br>";
                            // echo "Main title: " . $mainTitle . "<br>";
                        @endphp
                        <tr data-id="{{ $profession->id }}">
                            <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                            <td>{{ $profession->id }}</td>
                            <td>
                                <strong>{{ strtoupper($firstLanguage->lang_code ?? 'AZ') }}:</strong> {{ $mainTitle }}<br>
                                @foreach($languages as $language)
                                    @if($language !== $firstLanguage)
                                        @php
                                            $langTitle = $profession->getTranslation('title', $language->lang_code, false);
                                        @endphp
                                        @if($langTitle)
                                            <strong>{{ strtoupper($language->lang_code) }}:</strong> {{ $langTitle }}<br>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $profession->order }}</td>
                            <td>
                                @if($profession->status)
                                    <span class="badge bg-success">Aktiv</span>
                                @else
                                    <span class="badge bg-danger">Deaktiv</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.hero-professions.edit', $profession->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Redaktə et
                                </a>
                                <button class="btn btn-sm btn-danger delete-profession" data-id="{{ $profession->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
    var sortableProfessions = document.getElementById('sortableProfessions');
    if (sortableProfessions) {
        new Sortable(sortableProfessions, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortableProfessions tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.hero-professions.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortableProfessions tr').each(function(index) {
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

    // Delete Profession
    $('.delete-profession').on('click', function() {
        if (confirm('Bu peşəni silmək istədiyinizə əminsiniz?')) {
            var id = $(this).data('id');
            
            $.ajax({
                url: '/admin/hero-professions/' + id,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Xəta baş verdi!');
                }
            });
        }
    });
});
</script>
@endsection 