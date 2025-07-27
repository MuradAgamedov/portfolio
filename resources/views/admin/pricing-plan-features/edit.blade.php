@extends('admin.layouts.master')

@section('title', 'Edit Feature')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit"></i> Edit Feature
            </h1>
            <p class="text-muted">Editing feature for: {{ $pricingPlan->getTranslation('title', 'en') }}</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Feature Information</h6>
        </div>
        <div class="card-body">
            <!-- Validation Errors Display -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="mb-2"><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pricing-plans.features.update', [$pricingPlan, $feature]) }}" method="POST">
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
                                <label class="form-label">Title ({{ $language->title }}) <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="title_{{ $language->lang_code }}" 
                                       class="form-control @error('title_' . $language->lang_code) is-invalid @enderror"
                                       value="{{ old('title_' . $language->lang_code, $feature->getTranslation('title', $language->lang_code)) }}"
                                       required>
                                @error('title_' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status" {{ old('status', $feature->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Active
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pricing-plans.features.index', $pricingPlan) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Feature
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 