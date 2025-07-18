@extends('admin.layouts.master')

@section('title', 'Bacarıq Redaktə Et')

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

/* Range Slider Styles */
.range-slider {
    width: 100%;
    margin: 10px 0;
}

.range-slider input[type="range"] {
    width: 100%;
    height: 8px;
    border-radius: 5px;
    background: #ddd;
    outline: none;
    -webkit-appearance: none;
}

.range-slider input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #667eea;
    cursor: pointer;
}

.range-slider input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #667eea;
    cursor: pointer;
    border: none;
}

.percent-display {
    font-size: 1.5rem;
    font-weight: bold;
    color: #667eea;
    text-align: center;
    margin: 10px 0;
}

.progress-preview {
    height: 10px;
    border-radius: 5px;
    background: #e9ecef;
    overflow: hidden;
    margin: 10px 0;
}

.progress-bar-preview {
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: width 0.3s ease;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit"></i> Bacarıq Redaktə Et
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bacarıq Məlumatları</h6>
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

            <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
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
                                <label class="form-label">Bacarıq Adı ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="title[{{ $language->lang_code }}]" 
                                       class="form-control @error('title.' . $language->lang_code) is-invalid @enderror"
                                       value="{{ old('title.' . $language->lang_code, $skill->getTitle($language->lang_code)) }}"
                                       placeholder="Bacarıq adını daxil edin..."
                                       required>
                                @error('title.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Percentage Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-percentage"></i> Bacarıq Səviyyəsi</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="percent" class="form-label">Faiz <span class="text-danger">*</span></label>
                            <div class="percent-display" id="percentDisplay">{{ $skill->percent }}%</div>
                            <div class="progress-preview">
                                <div class="progress-bar-preview" id="progressPreview" style="width: {{ $skill->percent }}%"></div>
                            </div>
                            <div class="range-slider">
                                <input type="range" 
                                       id="percent" 
                                       name="percent" 
                                       min="0" 
                                       max="100" 
                                       value="{{ old('percent', $skill->percent) }}"
                                       class="form-control @error('percent') is-invalid @enderror">
                            </div>
                            <small class="form-text text-muted">0-100 arasında dəyər seçin</small>
                            @error('percent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $skill->status ? 'checked' : '' }}>
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
                            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">
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
$(document).ready(function() {
    // Percentage slider functionality
    $('#percent').on('input', function() {
        var value = $(this).val();
        $('#percentDisplay').text(value + '%');
        $('#progressPreview').css('width', value + '%');
    });

    // Initialize with current value
    var initialValue = $('#percent').val();
    $('#percentDisplay').text(initialValue + '%');
    $('#progressPreview').css('width', initialValue + '%');
});
</script>
@endsection 