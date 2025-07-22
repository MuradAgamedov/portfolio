@extends('admin.layouts.master')

@section('title', 'Hero Məlumatları')

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
                <i class="fas fa-edit"></i> Hero Məlumatları
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hero Bölməsi Redaktə Et</h6>
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

            <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Başlıq ({{ $language->title }}) <span class="text-danger">*</span></label>
                                    <input type="text"
                                        name="title[{{ $language->lang_code }}]"
                                        class="form-control @error('title.' . $language->lang_code) is-invalid @enderror"
                                        value="{{ old('title.' . $language->lang_code, $heroData->getTranslation('title', $language->lang_code)) }}"
                                        required>
                                    @error('title.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Etiket ({{ $language->title }}) <span class="text-danger">*</span></label>
                                    <input type="text"
                                        name="label[{{ $language->lang_code }}]"
                                        class="form-control @error('label.' . $language->lang_code) is-invalid @enderror"
                                        value="{{ old('label.' . $language->lang_code, $heroData->getTranslation('label', $language->lang_code)) }}"
                                        required>
                                    @error('label.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Şəkil Alt Mətni ({{ $language->title }}) <span class="text-danger">*</span></label>
                                    <input type="text"
                                        name="image_alt[{{ $language->lang_code }}]"
                                        class="form-control @error('image_alt.' . $language->lang_code) is-invalid @enderror"
                                        value="{{ old('image_alt.' . $language->lang_code, $heroData->getTranslation('image_alt', $language->lang_code)) }}"
                                        required>
                                    @error('image_alt.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mətn ({{ $language->title }}) <span class="text-danger">*</span></label>
                            <textarea name="text[{{ $language->lang_code }}]"
                                class="form-control @error('text.' . $language->lang_code) is-invalid @enderror"
                                rows="4"
                                required>{{ old('text.' . $language->lang_code, $heroData->getTranslation('text', $language->lang_code)) }}</textarea>
                            @error('text.' . $language->lang_code)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hero Şəkli</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Maksimum ölçü: 2MB. Formatlar: JPEG, PNG, JPG, GIF, WEBP</small>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div class="image-preview {{ $heroData->image ? 'has-image' : '' }}" id="imagePreview">
                    @if($heroData->image)
                    <img src="{{ asset('storage/' . $heroData->image) }}" alt="Hero Image" class="img-fluid">
                    <p class="mt-2 mb-0 text-muted">Cari şəkil</p>
                    @else
                    <i class="fas fa-image fa-3x text-muted"></i>
                    <p class="mt-2 mb-0 text-muted">Şəkil seçilməyib</p>
                    @endif
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Yadda Saxla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Image preview
        $('#image').on('change', function() {
            var file = this.files[0];
            var preview = $('#imagePreview');

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.html('<img src="' + e.target.result + '" alt="Preview" class="img-fluid">');
                    preview.addClass('has-image');
                }
                reader.readAsDataURL(file);
            } else {
                preview.html('<i class="fas fa-image fa-3x text-muted"></i><p class="mt-2 mb-0 text-muted">Şəkil seçilməyib</p>');
                preview.removeClass('has-image');
            }
        });
    });
</script>
@endsection