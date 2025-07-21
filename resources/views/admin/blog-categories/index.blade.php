@extends('admin.layouts.master')

@section('title', 'Blog Kateqoriyaları')

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

#sortable-categories tr {
    transition: all 0.2s ease;
}

#sortable-categories tr:hover {
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

.language-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.language-tab {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    background: #e9ecef;
    color: #6c757d;
}

.language-tab.active {
    background: #667eea;
    color: white;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-tags"></i> Blog Kateqoriyaları
            </h1>
            <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Kateqoriya
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kateqoriya Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                <th>Başlıq</th>
                                <th>Slug</th>
                                <th>Sıra</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-categories">
                            @foreach($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                <td>
                                    <div>
                                        @php
                                            $languages = \App\Models\Language::where('status', true)->get();
                                            $firstLanguage = $languages->first();
                                            $mainTitle = $firstLanguage ? ($category->title[$firstLanguage->lang_code] ?? 'Başlıq yoxdur') : 'Başlıq yoxdur';
                                        @endphp
                                        <strong>{{ $mainTitle }}</strong>
                                        <div class="language-tabs">
                                            @foreach($languages as $language)
                                                <span class="language-tab {{ isset($category->title[$language->lang_code]) ? 'active' : '' }}">
                                                    {{ strtoupper($language->lang_code) }}
                                                </span>
                                            @endforeach
                                        </div>
                                        @php
                                            $otherTitles = [];
                                            foreach($languages as $language) {
                                                if($language !== $firstLanguage && isset($category->title[$language->lang_code])) {
                                                    $otherTitles[] = strtoupper($language->lang_code) . ': ' . $category->title[$language->lang_code];
                                                }
                                            }
                                        @endphp
                                        @if(!empty($otherTitles))
                                            <small class="text-muted">
                                                {{ implode(' | ', $otherTitles) }}
                                            </small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <code>{{ $category->getSlug() }}</code>
                                </td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    @if($category->status)
                                        <span class="badge bg-success status-badge">Aktiv</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.blog-categories.edit', $category) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.blog-categories.destroy', $category) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bu kateqoriyanı silmək istədiyinizə əminsiniz?')">
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
                    <i class="fas fa-tags"></i>
                    <h5>Hələ kateqoriya əlavə edilməyib</h5>
                    <p>Yeni kateqoriya əlavə etmək üçün yuxarıdakı düyməni istifadə edin</p>
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
    var sortableCategories = document.getElementById('sortable-categories');
    if (sortableCategories) {
        new Sortable(sortableCategories, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var items = [];
                $('#sortable-categories tr').each(function(index) {
                    items.push($(this).data('id'));
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.blog-categories.reorder") }}',
                    method: 'POST',
                    data: {
                        items: items,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortable-categories tr').each(function(index) {
                            $(this).find('td:eq(3)').text(index + 1);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Reorder error:', error);
                    }
                });
            }
        });
    }
});
</script>
@endsection 