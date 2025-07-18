@extends('admin.layouts.master')

@section('title', 'Haqqımda Redaktə Et')

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

.cv-preview {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

.cv-preview .cv-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cv-preview .cv-icon {
    font-size: 2rem;
    color: #dc3545;
}

.cv-preview .cv-details h6 {
    margin: 0;
    color: #495057;
}

.cv-preview .cv-details small {
    color: #6c757d;
}

.cv-actions {
    margin-top: 10px;
}

.cv-actions .btn {
    margin-right: 10px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user"></i> Haqqımda Redaktə Et
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Haqqımda Məlumatları</h6>
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

            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
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
                            
                            <div class="mb-3">
                                <label class="form-label">Təsvir ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <textarea name="description[{{ $language->lang_code }}]" 
                                          class="form-control @error('description.' . $language->lang_code) is-invalid @enderror"
                                          rows="8"
                                          placeholder="Haqqımda təsvirini daxil edin..."
                                          required>{{ old('description.' . $language->lang_code, $about->getDescription($language->lang_code)) }}</textarea>
                                @error('description.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- CV File Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-file-pdf"></i> CV Faylı</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cv_file" class="form-label">CV Faylı Yüklə</label>
                            <input type="file" 
                                   class="form-control @error('cv_file') is-invalid @enderror" 
                                   id="cv_file" 
                                   name="cv_file"
                                   accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">
                                Dəstəklənən formatlar: PDF, DOC, DOCX. Maksimum ölçü: 10MB
                            </small>
                            @error('cv_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($about->cv_file)
                            <div class="cv-preview">
                                <div class="cv-info">
                                    <div class="cv-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="cv-details">
                                        <h6>{{ $about->cv_original_name }}</h6>
                                        <small>
                                            Ölçü: {{ $about->getCvSize() }} MB | 
                                            Yüklənmə tarixi: {{ $about->updated_at->format('d.m.Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="cv-actions">
                                    <a href="{{ route('admin.about.download-cv') }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> CV Yüklə
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="removeCv()">
                                        <i class="fas fa-trash"></i> CV-ni Sil
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-cog"></i> Tənzimləmələr</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $about->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Aktiv
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Geri Qayıt
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Dəyişiklikləri Saxla
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
function removeCv() {
    if (confirm('CV faylını silmək istədiyinizə əminsiniz?')) {
        // You can implement AJAX call here to remove CV file
        // For now, we'll just hide the preview
        document.querySelector('.cv-preview').style.display = 'none';
    }
}

// File size validation
document.getElementById('cv_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        if (file.size > maxSize) {
            alert('Fayl ölçüsü 10MB-dan çox ola bilməz!');
            this.value = '';
        }
    }
});
</script>
@endsection 