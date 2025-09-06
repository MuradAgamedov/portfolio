@extends('admin.layouts.master')

@section('title', 'Yeni Blog')

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

.image-preview {
    max-width: 200px;
    max-height: 200px;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    margin-top: 10px;
}

.image-preview img {
    max-width: 100%;
    max-height: 150px;
    object-fit: cover;
}

.image-preview.has-image {
    border-style: solid;
    border-color: #28a745;
}

.slug-field {
    position: relative;
}

.slug-edit-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #667eea;
    cursor: pointer;
}

.slug-edit-btn:hover {
    color: #5a6fd8;
}

.slug-field input[readonly] {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.slug-field input:not([readonly]) {
    background-color: white;
    cursor: text;
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus"></i> Yeni Blog
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blog Məlumatları</h6>
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

            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
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
                                               class="form-control @error('title.' . $language->lang_code) is-invalid @enderror"
                                               value="{{ old('title.' . $language->lang_code) }}"
                                               placeholder="Blog başlığını daxil edin..."
                                               required>
                                        @error('title.' . $language->lang_code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug ({{ $language->title }})</label>
                                        <div class="slug-field">
                                            <input type="text" 
                                                   name="slug[{{ $language->lang_code }}]" 
                                                   class="form-control slug-input"
                                                   data-lang="{{ $language->lang_code }}"
                                                   value="{{ old('slug.' . $language->lang_code) }}"
                                                   placeholder="Avtomatik generasiya olunacaq"
                                                   readonly>
                                            <button type="button" class="slug-edit-btn" data-lang="{{ $language->lang_code }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">Avtomatik generasiya olunur, dəyişdirmək üçün qələm düyməsinə basın</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Card Şəkli Alt Mətni ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="card_image_alt_text[{{ $language->lang_code }}]" 
                                       class="form-control @error('card_image_alt_text.' . $language->lang_code) is-invalid @enderror"
                                       value="{{ old('card_image_alt_text.' . $language->lang_code) }}"
                                       placeholder="Card şəkli üçün alt mətn..."
                                       required>
                                @error('card_image_alt_text.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Əsas Şəkil Alt Mətni ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="main_image_alt_text[{{ $language->lang_code }}]" 
                                       class="form-control @error('main_image_alt_text.' . $language->lang_code) is-invalid @enderror"
                                       value="{{ old('main_image_alt_text.' . $language->lang_code) }}"
                                       placeholder="Əsas şəkil üçün alt mətn..."
                                       required>
                                @error('main_image_alt_text.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Əsas Təsvir ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <textarea name="main_description[{{ $language->lang_code }}]" 
                                          class="form-control ckeditor @error('main_description.' . $language->lang_code) is-invalid @enderror"
                                          data-lang="{{ $language->lang_code }}"
                                          rows="6"
                                          required>{{ old('main_description.' . $language->lang_code) }}</textarea>
                                @error('main_description.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                      

                            <!-- SEO Section -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-search"></i> SEO Məlumatları ({{ $language->title }})</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">SEO Başlıq</label>
                                        <input type="text" 
                                               name="seo_title[{{ $language->lang_code }}]" 
                                               class="form-control"
                                               value="{{ old('seo_title.' . $language->lang_code) }}"
                                               placeholder="SEO başlığı...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Açar Sözlər</label>
                                        <textarea name="seo_keywords[{{ $language->lang_code }}]" 
                                                  class="form-control"
                                                  rows="2"
                                                  placeholder="Açar sözləri vergüllə ayırın...">{{ old('seo_keywords.' . $language->lang_code) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Təsvir</label>
                                        <textarea name="seo_description[{{ $language->lang_code }}]" 
                                                  class="form-control"
                                                  rows="3"
                                                  placeholder="SEO təsviri...">{{ old('seo_description.' . $language->lang_code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Media Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-images"></i> Media</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="card_image" class="form-label">Card Şəkli</label>
                                    <input type="file" class="form-control @error('card_image') is-invalid @enderror" 
                                           id="card_image" name="card_image" accept="image/*">
                                    <small class="form-text text-muted">Maksimum ölçü: 2MB. Formatlar: JPEG, PNG, JPG, GIF</small>
                                    @error('card_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="image-preview" id="cardImagePreview">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="mt-2 mb-0 text-muted">Card şəkli seçilməyib</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="main_image" class="form-label">Əsas Şəkil</label>
                                    <input type="file" class="form-control @error('main_image') is-invalid @enderror" 
                                           id="main_image" name="main_image" accept="image/*">
                                    <small class="form-text text-muted">Maksimum ölçü: 2MB. Formatlar: JPEG, PNG, JPG, GIF</small>
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="image-preview" id="mainImagePreview">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="mt-2 mb-0 text-muted">Əsas şəkil seçilməyib</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-cog"></i> Tənzimləmələr</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kateqoriya</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id">
                                        <option value="">Kateqoriya seçin...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->getTitle() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Nəşr Tarixi</label>
                                    <input type="datetime-local" 
                                           class="form-control @error('published_at') is-invalid @enderror" 
                                           id="published_at" 
                                           name="published_at"
                                           value="{{ old('published_at') }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                                        <label class="form-check-label" for="status">
                                            Aktiv
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Geri Qayıt
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Blog Yarat
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
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
// Russian character conversion functions
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

$(document).ready(function() {
    // Initialize CKEditor for all textareas
    var editors = {};
    
    $('.ckeditor').each(function() {
        var textarea = $(this);
        var lang = textarea.data('lang');
        var editorName = 'editor_' + lang + '_' + textarea.attr('name').replace(/[\[\]]/g, '_');
        
        ClassicEditor
            .create(textarea[0], {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
                language: 'az'
            })
            .then(function(editor) {
                editors[editorName] = editor;
                
                // Update textarea when editor content changes
                editor.model.document.on('change:data', function() {
                    textarea.val(editor.getData());
                });
            })
            .catch(function(error) {
                console.error(error);
            });
    });

    // Slug edit functionality
    $('.slug-edit-btn').on('click', function() {
        var lang = $(this).data('lang');
        var input = $('.slug-input[data-lang="' + lang + '"]');
        var btn = $(this);
        
        if (input.prop('readonly')) {
            input.prop('readonly', false);
            btn.html('<i class="fas fa-check"></i>');
            input.focus();
        } else {
            input.prop('readonly', true);
            btn.html('<i class="fas fa-edit"></i>');
        }
    });

    // Auto-generate slug from title
    $('input[name^="title["]').on('input', function() {
        var lang = $(this).attr('name').match(/\[([^\]]+)\]/)[1];
        var title = $(this).val();
        var slugInput = $('.slug-input[data-lang="' + lang + '"]');
        
        if (slugInput.prop('readonly')) {
            var slug = generateSlugFinal(title, lang);
            slugInput.val(slug);
        }
    });

    // Image preview functionality
    $('#card_image').on('change', function() {
        var file = this.files[0];
        var preview = $('#cardImagePreview');
        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.html('<img src="' + e.target.result + '" alt="Preview" class="img-fluid">');
                preview.addClass('has-image');
            }
            reader.readAsDataURL(file);
        } else {
            preview.html('<i class="fas fa-image fa-3x text-muted"></i><p class="mt-2 mb-0 text-muted">Card şəkli seçilməyib</p>');
            preview.removeClass('has-image');
        }
    });

    $('#main_image').on('change', function() {
        var file = this.files[0];
        var preview = $('#mainImagePreview');
        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.html('<img src="' + e.target.result + '" alt="Preview" class="img-fluid">');
                preview.addClass('has-image');
            }
            reader.readAsDataURL(file);
        } else {
            preview.html('<i class="fas fa-image fa-3x text-muted"></i><p class="mt-2 mb-0 text-muted">Əsas şəkil seçilməyib</p>');
            preview.removeClass('has-image');
        }
    });
});
</script>
@endsection 