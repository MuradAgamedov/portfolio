@extends('admin.layouts.master')

@section('title', 'Yeni Peşə Əlavə Et')

@section('styles')
<style>
.language-tab {
    cursor: pointer;
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    border-bottom: none;
    background: #f8f9fa;
    border-radius: 4px 4px 0 0;
    margin-right: 3px;
    font-size: 0.9rem;
}

.language-tab.active {
    background: white;
    border-color: #007bff;
    color: #007bff;
}

.language-content {
    display: none;
    padding: 15px;
    border: 1px solid #dee2e6;
    border-radius: 0 4px 4px 4px;
}

.language-content.active {
    display: block;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus"></i> Yeni Peşə Əlavə Et
            </h1>
            <a href="{{ route('admin.hero-professions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Geri Qayıt
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peşə Məlumatları</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hero-professions.store') }}" method="POST">
                @csrf
                
                <!-- Language Tabs -->
                <div class="mb-3">
                    <div class="d-flex">
                        @foreach($languages as $index => $language)
                            <div class="language-tab {{ $index === 0 ? 'active' : '' }}" data-lang="{{ $language->lang_code }}">{{ $language->title }}</div>
                        @endforeach
                    </div>
                </div>

                @foreach($languages as $index => $language)
                    <div class="language-content {{ $index === 0 ? 'active' : '' }}" data-lang="{{ $language->lang_code }}">
                        <div class="mb-3">
                            <label for="title_{{ $language->lang_code }}" class="form-label">Peşə Adı ({{ $language->title }})</label>
                            <input type="text" 
                                   class="form-control @error('title.' . $language->lang_code) is-invalid @enderror" 
                                   id="title_{{ $language->lang_code }}" 
                                   name="title[{{ $language->lang_code }}]" 
                                   value="{{ old('title.' . $language->lang_code) }}"
                                   required>
                            @error('title.' . $language->lang_code)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Aktiv
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.hero-professions.index') }}" class="btn btn-secondary me-2">Ləğv Et</a>
                    <button type="submit" class="btn btn-primary">Əlavə Et</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Language tab switching
    $('.language-tab').on('click', function() {
        var lang = $(this).data('lang');
        
        // Remove active class from all tabs and contents
        $('.language-tab').removeClass('active');
        $('.language-content').removeClass('active');
        
        // Add active class to clicked tab and corresponding content
        $(this).addClass('active');
        $('.language-content[data-lang="' + lang + '"]').addClass('active');
    });
});
</script>
@endsection 