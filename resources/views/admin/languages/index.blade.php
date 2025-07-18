@extends('admin.layouts.master')

@section('title', 'Dillər')

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

#sortableLanguages tr {
    transition: all 0.2s ease;
}

#sortableLanguages tr:hover {
    background-color: #f8f9fa;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-language"></i> Dillər
            </h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLanguageModal">
                <i class="fas fa-plus"></i> Yeni Dil Əlavə Et
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dillər Siyahısı</h6>
        </div>
        <div class="card-body">
                                <div class="table-responsive">
                        <table class="table table-bordered" id="languagesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>Kod</th>
                                    <th>Əsas Dil</th>
                                    <th>Sıra</th>
                                    <th>Status</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody id="sortableLanguages">
                                @foreach($languages as $language)
                                <tr data-id="{{ $language->id }}">
                                    <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                    <td>{{ $language->id }}</td>
                                    <td>{{ $language->title }}</td>
                                    <td><span class="badge bg-info">{{ $language->lang_code }}</span></td>
                                    <td>
                                        @if($language->is_main_lang)
                                            <span class="badge bg-success">Əsas</span>
                                        @else
                                            <span class="badge bg-secondary">Köhnə</span>
                                        @endif
                                    </td>
                                    <td>{{ $language->order }}</td>
                                    <td>
                                        @if($language->status)
                                            <span class="badge bg-success">Aktiv</span>
                                        @else
                                            <span class="badge bg-danger">Deaktiv</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-language" 
                                                data-id="{{ $language->id }}"
                                                data-title="{{ $language->title }}"
                                                data-lang_code="{{ $language->lang_code }}"
                                                data-is_main_lang="{{ $language->is_main_lang }}"
                                                data-status="{{ $language->status }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-language" data-id="{{ $language->id }}">
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

<!-- Add Language Modal -->
<div class="modal fade" id="addLanguageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Dil Əlavə Et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addLanguageForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Dil Adı</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="lang_code" class="form-label">Dil Kodu</label>
                        <input type="text" class="form-control" id="lang_code" name="lang_code" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_main_lang" name="is_main_lang">
                            <label class="form-check-label" for="is_main_lang">
                                Əsas Dil
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                            <label class="form-check-label" for="status">
                                Aktiv
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ləğv Et</button>
                    <button type="submit" class="btn btn-primary">Əlavə Et</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Language Modal -->
<div class="modal fade" id="editLanguageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dili Redaktə Et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editLanguageForm">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Dil Adı</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_lang_code" class="form-label">Dil Kodu</label>
                        <input type="text" class="form-control" id="edit_lang_code" name="lang_code" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_main_lang" name="is_main_lang">
                            <label class="form-check-label" for="edit_is_main_lang">
                                Əsas Dil
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_status" name="status">
                            <label class="form-check-label" for="edit_status">
                                Aktiv
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ləğv Et</button>
                    <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                </div>
            </form>
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
    var sortableLanguages = document.getElementById('sortableLanguages');
    if (sortableLanguages) {
        new Sortable(sortableLanguages, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortableLanguages tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.languages.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortableLanguages tr').each(function(index) {
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
    // Add Language
    $('#addLanguageForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            title: $('#title').val(),
            lang_code: $('#lang_code').val(),
            is_main_lang: $('#is_main_lang').is(':checked') ? true : false,
            status: $('#status').is(':checked') ? true : false,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '{{ route("admin.languages.store") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#addLanguageModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Xəta baş verdi!');
            }
        });
    });

    // Edit Language
    $('.edit-language').on('click', function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var lang_code = $(this).data('lang_code');
        var is_main_lang = $(this).data('is_main_lang');
        var status = $(this).data('status');

        $('#edit_id').val(id);
        $('#edit_title').val(title);
        $('#edit_lang_code').val(lang_code);
        $('#edit_is_main_lang').prop('checked', is_main_lang == 1);
        $('#edit_status').prop('checked', status == 1);

        $('#editLanguageModal').modal('show');
    });

    // Update Language
    $('#editLanguageForm').on('submit', function(e) {
        e.preventDefault();
        
        var id = $('#edit_id').val();
        
        var formData = {
            title: $('#edit_title').val(),
            lang_code: $('#edit_lang_code').val(),
            is_main_lang: $('#edit_is_main_lang').is(':checked') ? true : false,
            status: $('#edit_status').is(':checked') ? true : false,
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT'
        };

        
        $.ajax({
            url: '/admin/languages/' + id,
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#editLanguageModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Xəta baş verdi!');
            }
        });
    });

    // Delete Language
    $('.delete-language').on('click', function() {
        if (confirm('Bu dili silmək istədiyinizə əminsiniz?')) {
            var id = $(this).data('id');
            
            $.ajax({
                url: '/admin/languages/' + id,
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