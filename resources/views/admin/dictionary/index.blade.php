@extends('admin.layouts.master')

@section('title', 'Tərcümə Sözlüyü')

@section('styles')
<style>
.keyword-text {
    font-family: 'Courier New', monospace;
    background-color: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 0.875rem;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-book"></i> Tərcümə Sözlüyü
                </h1>
                <div>
                    <a href="{{ route('admin.dictionary.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Tərcümə
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Axtar</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="searchFilter" class="form-label">Axtar</label>
                    <input type="text" class="form-control" id="searchFilter" placeholder="Açar söz və ya tərcümə...">
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tərcümə Siyahısı</h6>
        </div>
        <div class="card-body">
            @if($dictionaries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dictionaryTable">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Açar Söz</th>
                                <th>Tərcümələr</th>
                                <th width="150">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dictionaries as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <div class="keyword-text">{{ $item->keyword }}</div>
                                    </td>
                                    <td>
                                        @foreach($item->getAllValues() as $lang => $value)
                                            <div class="mb-1">
                                                <strong>{{ strtoupper($lang) }}:</strong> 
                                                <span>{{ Str::limit($value, 50) }}</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.dictionary.edit', $item) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Redaktə et">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.dictionary.destroy', $item) }}" 
                                                  method="POST" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Bu tərcüməni silmək istədiyinizə əminsiniz?')">
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
                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Hələ heç bir tərcümə əlavə edilməyib</h5>
                    <p class="text-muted">İlk tərcüməni əlavə etmək üçün "Yeni Tərcümə" düyməsinə basın</p>
                    <a href="{{ route('admin.dictionary.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Tərcümə
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Filter functionality
    $('#searchFilter').on('keyup', function() {
        var searchFilter = $(this).val().toLowerCase();

        $('#dictionaryTable tbody tr').each(function() {
            var row = $(this);
            var text = row.text().toLowerCase();
            var show = true;

            // Search filter
            if (searchFilter && !text.includes(searchFilter)) {
                show = false;
            }

            row.toggle(show);
        });
    });
});
</script>
@endsection 