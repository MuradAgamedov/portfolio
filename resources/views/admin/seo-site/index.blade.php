@extends('admin.layouts.master')

@section('title', 'SEO Site Settings')

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

.card {
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px 12px 0 0 !important;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    padding: 12px 30px;
    font-weight: 600;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

textarea {
    font-family: 'Courier New', monospace;
    font-size: 13px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO Site Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seo-site.update') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- SEO Content -->
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">SEO Content</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- Language Tabs -->
                                        <ul class="nav nav-tabs" id="seoContentTabs" role="tablist">
                                            @foreach($languages as $language)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                            id="tab-seo-{{ $language->lang_code }}" 
                                                            data-bs-toggle="tab" 
                                                            data-bs-target="#content-seo-{{ $language->lang_code }}" 
                                                            type="button" 
                                                            role="tab">
                                                        <i class="fas fa-flag"></i> {{ $language->title }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content" id="seoContentTabContent">
                                            @foreach($languages as $language)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                                     id="content-seo-{{ $language->lang_code }}" 
                                                     role="tabpanel">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">SEO Title ({{ $language->title }}) <span class="text-danger">*</span></label>
                                                                <input type="text" 
                                                                       name="seo_title_{{ $language->lang_code }}" 
                                                                       class="form-control"
                                                                       value="{{ $seo->getTranslation('seo_title', $language->lang_code) }}"
                                                                       placeholder="SEO title in {{ $language->title }}">
                                                                <small class="text-muted">This will be used as the page title for search engines</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">SEO Keywords ({{ $language->title }})</label>
                                                                <textarea name="seo_keywords_{{ $language->lang_code }}" 
                                                                          class="form-control" 
                                                                          rows="3"
                                                                          placeholder="Enter SEO keywords in {{ $language->title }}">{{ $seo->getTranslation('seo_keywords', $language->lang_code) }}</textarea>
                                                                <small class="text-muted">Enter keywords separated by commas</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">SEO Description ({{ $language->title }})</label>
                                                                <textarea name="seo_description_{{ $language->lang_code }}" 
                                                                          class="form-control" 
                                                                          rows="3"
                                                                          placeholder="Enter SEO description in {{ $language->title }}">{{ $seo->getTranslation('seo_description', $language->lang_code) }}</textarea>
                                                                <small class="text-muted">Recommended: 150-160 characters</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Page Header -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Page Header</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Page Header Code:</label>
                                            <textarea name="page_header" class="form-control" rows="6" 
                                                      placeholder="Enter HTML/JavaScript code for page header">{{ $seo->page_header }}</textarea>
                                            <small class="text-muted">This code will be added to the &lt;head&gt; section of your pages</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Page Footer -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Page Footer</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Page Footer Code:</label>
                                            <textarea name="page_footer" class="form-control" rows="6" 
                                                      placeholder="Enter HTML/JavaScript code for page footer">{{ $seo->page_footer }}</textarea>
                                            <small class="text-muted">This code will be added before the closing &lt;/body&gt; tag</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Options -->
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">SEO Options</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="index" id="index" 
                                                           {{ $seo->index ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="index">
                                                        Allow Indexing
                                                    </label>
                                                    <small class="form-text text-muted d-block">Allow search engines to index this page</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="follow" id="follow" 
                                                           {{ $seo->follow ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="follow">
                                                        Allow Following Links
                                                    </label>
                                                    <small class="form-text text-muted d-block">Allow search engines to follow links on this page</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Save SEO Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 