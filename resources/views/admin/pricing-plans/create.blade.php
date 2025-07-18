@extends('admin.layouts.master')

@section('title', 'Create Pricing Plan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Pricing Plan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pricing-plans.store') }}" method="POST">
                        @csrf
                        
                        <!-- Language Tabs -->
                        <ul class="nav nav-tabs" id="pricingPlanTabs" role="tablist">
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

                        <div class="tab-content" id="pricingPlanTabContent">
                            @foreach($languages as $language)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                     id="content-{{ $language->lang_code }}" 
                                     role="tabpanel">
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Title ({{ $language->title }}) <span class="text-danger">*</span></label>
                                                <input type="text" 
                                                       name="title_{{ $language->lang_code }}" 
                                                       class="form-control @error('title_' . $language->lang_code) is-invalid @enderror"
                                                       value="{{ old('title_' . $language->lang_code) }}"
                                                       placeholder="Enter title in {{ $language->title }}">
                                                @error('title_' . $language->lang_code)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Price ({{ $language->title }}) <span class="text-danger">*</span></label>
                                                <input type="text" 
                                                       name="price_{{ $language->lang_code }}" 
                                                       class="form-control @error('price_' . $language->lang_code) is-invalid @enderror"
                                                       value="{{ old('price_' . $language->lang_code) }}"
                                                       placeholder="e.g., $29/month or 29₼/ay">
                                                @error('price_' . $language->lang_code)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                                        <label class="form-check-label" for="status">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create Pricing Plan
                                </button>
                                <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 