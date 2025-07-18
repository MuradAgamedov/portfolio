@extends('admin.layouts.master')

@section('title', 'Blog')

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

#sortable-blogs tr {
    transition: all 0.2s ease;
}

#sortable-blogs tr:hover {
    background-color: #f8f9fa;
}

.blog-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.published-badge {
    font-size: 0.7rem;
    padding: 0.2rem 0.4rem;
}

.language-tabs {
    display: flex;
    gap: 5px;
    margin-bottom: 5px;
}

.language-tab {
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.7rem;
    font-weight: 500;
    background: #e9ecef;
    color: #6c757d;
}

.language-tab.active {
    background: #667eea;
    color: white;
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
                <i class="fas fa-blog"></i> Blog
            </h1>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Blog
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blog Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($blogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50"><i class="fas fa-grip-vertical"></i></th>
                                <th width="80">Şəkil</th>
                                <th>Başlıq</th>
                                <th>Slug</th>
                                <th>Nəşr Tarixi</th>
                                <th>Sıra</th>
                                <th>Status</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-blogs">
                            @foreach($blogs as $blog)
                            @php
                                $languages = \App\Models\Language::where('status', true)->get();
                                $firstLanguage = $languages->first();
                                $mainTitle = $firstLanguage ? ($blog->title[$firstLanguage->lang_code] ?? 'Başlıq yoxdur') : 'Başlıq yoxdur';
                                $mainSlug = $firstLanguage ? ($blog->slug[$firstLanguage->lang_code] ?? 'slug-yoxdur') : 'slug-yoxdur';
                            @endphp
                            <tr data-id="{{ $blog->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-vertical text-muted"></i></td>
                                <td>
                                    @if($blog->card_image)
                                        <img src="{{ $blog->getCardImageUrl() }}" alt="Blog Image" class="blog-image">
                                    @else
                                        <div class="blog-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $mainTitle }}</strong>
                                        <div class="language-tabs">
                                            @foreach($languages as $language)
                                                <span class="language-tab {{ isset($blog->title[$language->lang_code]) ? 'active' : '' }}">
                                                    {{ strtoupper($language->lang_code) }}
                                                </span>
                                            @endforeach
                                        </div>
                                        @php
                                            $otherTitles = [];
                                            foreach($languages as $language) {
                                                if($language !== $firstLanguage && isset($blog->title[$language->lang_code])) {
                                                    $otherTitles[] = strtoupper($language->lang_code) . ': ' . $blog->title[$language->lang_code];
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
                                    <code>{{ $mainSlug }}</code>
                                </td>
                                <td>
                                    @if($blog->published_at)
                                        <span class="badge bg-info published-badge">
                                            {{ $blog->getFormattedPublishedDate() }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning published-badge">Nəşr edilməyib</span>
                                    @endif
                                </td>
                                <td>{{ $blog->order }}</td>
                                <td>
                                    @if($blog->status)
                                        <span class="badge bg-success status-badge">Aktiv</span>
                                    @else
                                        <span class="badge bg-secondary status-badge">Deaktiv</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.blogs.edit', $blog) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bu blogu silmək istədiyinizə əminsiniz?')">
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
                    <i class="fas fa-blog"></i>
                    <h5>Hələ blog əlavə edilməyib</h5>
                    <p>Yeni blog əlavə etmək üçün yuxarıdakı düyməni istifadə edin</p>
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
    var sortableBlogs = document.getElementById('sortable-blogs');
    if (sortableBlogs) {
        new Sortable(sortableBlogs, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                var orders = [];
                $('#sortable-blogs tr').each(function(index) {
                    orders.push({
                        id: $(this).data('id'),
                        order: index
                    });
                });
                
                // Send reorder request
                $.ajax({
                    url: '{{ route("admin.blogs.reorder") }}',
                    method: 'POST',
                    data: {
                        orders: orders,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update order numbers in table
                        $('#sortable-blogs tr').each(function(index) {
                            $(this).find('td:eq(5)').text(index);
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