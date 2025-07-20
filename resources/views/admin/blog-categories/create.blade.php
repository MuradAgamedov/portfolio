@extends('admin.layouts.master')

@section('title', 'Yeni Blog Kateqoriyası')

@section('styles')
<style>
.nav-tabs .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    border-bottom-color: #667eea;
    color: #667eea;
    background: none;
}

.tab-content {
    padding: 20px 0;
}

/* Validation Error Styles */
.validation-errors {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    color: #721c24;
}

.validation-errors ul {
    margin: 0;
    padding-left: 20px;
}

.validation-errors li {
    margin-bottom: 5px;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.invalid-feedback {
    display: block !important;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
}

.custom-switch {
    padding-left: 2.25rem;
}

.custom-switch .custom-control-label {
    padding-top: 2px;
    font-weight: 500;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus"></i> Yeni Blog Kateqoriyası
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kateqoriya Məlumatları</h6>
        </div>
        <div class="card-body">
            <!-- Validation Errors Display -->
            @if ($errors->any())
                <div class="validation-errors">
                    <h6 class="mb-2"><i class="fas fa-exclamation-triangle"></i> Aşağıdakı xətaları düzəldin:</h6>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.blog-categories.store') }}" method="POST">
                @csrf

                <!-- Language Tabs -->
                <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                    @foreach($languages as $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                    id="tab-{{ $language->lang_code }}" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#content-{{ $language->lang_code }}" 
                                    type="button" 
                                    role="tab">
                                <i class="fas fa-flag"></i> {{ $language->title }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="languageTabContent">
                    @foreach($languages as $language)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                             id="content-{{ $language->lang_code }}" 
                             role="tabpanel">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Başlıq ({{ $language->title }}) <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               name="title[{{ $language->lang_code }}]" 
                                               class="form-control title-input @error('title.' . $language->lang_code) is-invalid @enderror"
                                               data-lang="{{ $language->lang_code }}"
                                               value="{{ old('title.' . $language->lang_code) }}"
                                               placeholder="Kateqoriya başlığını daxil edin..."
                                               required>
                                        @error('title.' . $language->lang_code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug ({{ $language->title }})</label>
                                        <input type="text" 
                                               name="slug[{{ $language->lang_code }}]" 
                                               class="form-control slug-input @error('slug.' . $language->lang_code) is-invalid @enderror"
                                               data-lang="{{ $language->lang_code }}"
                                               value="{{ old('slug.' . $language->lang_code) }}"
                                               placeholder="Slug avtomatik yaradılacaq..."
                                               readonly>
                                        @error('slug.' . $language->lang_code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Slug avtomatik olaraq başlıqdan yaradılır</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Status Toggle -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">
                                Aktiv
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Geri Qayıt
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Kateqoriya Yarat
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-submit form when status changes
    $('#status').change(function() {
        // Optional: Add any status change logic here
    });
    
    // Auto-generate slug from title
    $('.title-input').on('input', function() {
        var title = $(this).val();
        var langCode = $(this).data('lang');
        var slug = generateSlugFinal(title, langCode);
        
        $('.slug-input[data-lang="' + langCode + '"]').val(slug);
    });
    
    // Generate slug function with multi-language support
    function generateSlug(text, lang = 'az') {
        // Convert to lowercase
        text = text.toLowerCase();
        
        // Handle different languages
        switch (lang) {
            case 'ru':
                return convertRussianToLatin(text);
            case 'az':
                return convertAzerbaijaniToLatin(text);
            case 'en':
                return convertEnglishToLatin(text);
            default:
                return convertToLatin(text);
        }
    }
    
    function convertRussianToLatin(text) {
        const cyrillicMap = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'sch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
            'А': 'a', 'Б': 'b', 'В': 'v', 'Г': 'g', 'Д': 'd', 'Е': 'e', 'Ё': 'yo', 'Ж': 'zh', 'З': 'z', 'И': 'i', 'Й': 'y', 'К': 'k', 'Л': 'l', 'М': 'm', 'Н': 'n', 'О': 'o', 'П': 'p', 'Р': 'r', 'С': 's', 'Т': 't', 'У': 'u', 'Ф': 'f', 'Х': 'h', 'Ц': 'ts', 'Ч': 'ch', 'Ш': 'sh', 'Щ': 'sch', 'Ъ': '', 'Ы': 'y', 'Ь': '', 'Э': 'e', 'Ю': 'yu', 'Я': 'ya'
        };
        
        return text.replace(/[а-яёА-ЯЁ]/g, function(match) {
            return cyrillicMap[match] || match;
        });
    }
    
    function convertAzerbaijaniToLatin(text) {
        const azerbaijaniMap = {
            'ə': 'e', 'ğ': 'gh', 'ü': 'u', 'ş': 'sh', 'ı': 'i', 'ö': 'o', 'ç': 'ch',
            'Ə': 'e', 'Ğ': 'gh', 'Ü': 'u', 'Ş': 'sh', 'I': 'i', 'Ö': 'o', 'Ç': 'ch'
        };
        
        return text.replace(/[əğüşıöçƏĞÜŞIÖÇ]/g, function(match) {
            return azerbaijaniMap[match] || match;
        });
    }
    
    function convertEnglishToLatin(text) {
        return text;
    }
    
    function convertToLatin(text) {
        text = convertAzerbaijaniToLatin(text);
        text = convertRussianToLatin(text);
        return text;
    }
    
    function generateSlugFinal(text, lang = 'az') {
        let slug = generateSlug(text, lang);
        
        // Remove special characters except spaces and hyphens
        slug = slug.replace(/[^\w\s-]/g, '');
        
        // Replace spaces with hyphens
        slug = slug.replace(/\s+/g, '-');
        
        // Replace multiple hyphens with single hyphen
        slug = slug.replace(/-+/g, '-');
        
        // Remove leading/trailing hyphens
        slug = slug.replace(/^-+|-+$/g, '');
        
        return slug;
    }
});
</script>
@endsection 