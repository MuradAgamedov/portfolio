@extends('admin.layouts.master')

@section('title', 'Yeni Sertifikat')

@section('styles')
<style>
.certificate-preview {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    margin: 0 auto 8px;
}

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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus"></i> Yeni Sertifikat
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sertifikat Məlumatları</h6>
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

            <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Image Upload -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Sertifikat Şəkli <span class="text-danger">*</span></label>
                        <div class="certificate-preview" id="imagePreview">
                            <i class="fas fa-image"></i>
                        </div>
                        <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                        <small class="form-text text-muted">Dəstəklənən formatlar: JPEG, PNG, JPG, GIF, SVG. Maksimum ölçü: 2MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Şəkil Önizləmə</label>
                        <div id="previewContainer" class="border rounded p-3 text-center" style="min-height: 120px; display: flex; align-items: center; justify-content: center;">
                            <span class="text-muted">Şəkil seçildikdə burada görünəcək</span>
                        </div>
                    </div>
                </div>

                <!-- Issue Date -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Verilə Tarixi <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="issue_date" 
                                   class="form-control @error('issue_date') is-invalid @enderror"
                                   value="{{ old('issue_date') }}"
                                   required>
                            @error('issue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

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
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Başlıq ({{ $language->title }}) <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               name="title[{{ $language->lang_code }}]" 
                                               class="form-control @error('title.' . $language->lang_code) is-invalid @enderror"
                                               value="{{ old('title.' . $language->lang_code) }}"
                                               required>
                                        @error('title.' . $language->lang_code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Şəkil Alt Mətn ({{ $language->title }}) <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               name="image_alt_text[{{ $language->lang_code }}]" 
                                               class="form-control @error('image_alt_text.' . $language->lang_code) is-invalid @enderror"
                                               value="{{ old('image_alt_text.' . $language->lang_code) }}"
                                               required>
                                        @error('image_alt_text.' . $language->lang_code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Təsvir ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <textarea name="description[{{ $language->lang_code }}]" 
                                          class="form-control @error('description.' . $language->lang_code) is-invalid @enderror"
                                          rows="4"
                                          required>{{ old('description.' . $language->lang_code) }}</textarea>
                                @error('description.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                        <label class="form-check-label" for="status">
                            Aktiv
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri
                    </a>
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
    $('#imageInput').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewContainer').html('<img src="' + e.target.result + '" style="max-width: 100%; max-height: 120px; object-fit: contain;">');
            };
            reader.readAsDataURL(file);
        } else {
            $('#previewContainer').html('<span class="text-muted">Şəkil seçildikdə burada görünəcək</span>');
        }
    });
});
</script>
@endsection 