@extends('admin.layouts.master')

@section('title', 'Site Settings')

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

.input-group-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    font-weight: 600;
    min-width: 50px;
    justify-content: center;
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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Site Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            {{-- Contact Title --}}
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Contact Title</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="contactTitleTabs" role="tablist">
                                            @foreach($languages as $language)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                            id="tab-title-{{ $language->lang_code }}" 
                                                            data-bs-toggle="tab" 
                                                            data-bs-target="#content-title-{{ $language->lang_code }}" 
                                                            type="button" role="tab">
                                                        <i class="fas fa-flag"></i> {{ $language->title }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content" id="contactTitleTabContent">
                                            @foreach($languages as $language)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                                     id="content-title-{{ $language->lang_code }}" role="tabpanel">
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label">Contact Title ({{ $language->title }})</label>
                                                        <input type="text" 
                                                               name="title_{{ $language->lang_code }}" 
                                                               class="form-control"
                                                               value="{{ $settings->getTranslation('title', $language->lang_code) }}"
                                                               placeholder="Contact title in {{ $language->title }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Contact Section Content (başlıq və mətn) --}}
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Contact Section Content</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="contactSectionTabs" role="tablist">
                                            @foreach($languages as $language)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                            id="tab-contact-{{ $language->lang_code }}" 
                                                            data-bs-toggle="tab" 
                                                            data-bs-target="#content-contact-{{ $language->lang_code }}" 
                                                            type="button" role="tab">
                                                        <i class="fas fa-flag"></i> {{ $language->title }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content" id="contactSectionTabContent">
                                            @foreach($languages as $language)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                                     id="content-contact-{{ $language->lang_code }}" role="tabpanel">
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Section Title ({{ $language->title }})</label>
                                                            <input type="text" 
                                                                   name="contact_section_title_{{ $language->lang_code }}" 
                                                                   class="form-control"
                                                                   value="{{ $settings->getTranslation('contact_section_title', $language->lang_code) }}"
                                                                   placeholder="Title in {{ $language->title }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Section Text ({{ $language->title }})</label>
                                                            <textarea name="contact_section_text_{{ $language->lang_code }}" 
                                                                      class="form-control" rows="3"
                                                                      placeholder="Text in {{ $language->title }}">{{ $settings->getTranslation('contact_section_text', $language->lang_code) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Contact Information --}}
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Contact Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Phone:</label>
                                            <input type="text" name="phone" class="form-control" 
                                                   value="{{ $settings->phone }}" placeholder="Phone number">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" name="email" class="form-control" 
                                                   value="{{ $settings->email }}" placeholder="Email address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Contact Section Image --}}
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Contact Section Image</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($settings->contact_section_image)
                                            <div class="mb-3">
                                                <label class="form-label">Current Image:</label>
                                                <img src="{{ asset('storage/' . $settings->contact_section_image) }}" 
                                                     alt="Contact Section Image" 
                                                     class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Image:</label>
                                            <input type="file" name="contact_section_image" class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image Alt Text:</label>
                                            @foreach($languages as $language)
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">{{ strtoupper($language->lang_code) }}</span>
                                                    <input type="text" name="contact_section_alt_{{ $language->lang_code }}" class="form-control" 
                                                           value="{{ $settings->getTranslation('contact_section_alt', $language->lang_code) }}" 
                                                           placeholder="Alt text in {{ $language->title }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Favicon --}}
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Favicon</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($settings->favicon)
                                            <div class="mb-3">
                                                <label class="form-label">Current Favicon:</label>
                                                <img src="{{ asset('storage/' . $settings->favicon) }}" 
                                                     alt="Favicon" 
                                                     class="img-thumbnail" 
                                                     style="max-height: 50px;">
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Favicon:</label>
                                            <input type="file" name="favicon" class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended size: 32x32 or 16x16 pixels</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Header Logo --}}
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Header Logo</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($settings->header_logo)
                                            <div class="mb-3">
                                                <label class="form-label">Current Logo:</label>
                                                <img src="{{ asset('storage/' . $settings->header_logo) }}" 
                                                     alt="Header Logo" 
                                                     class="img-thumbnail" 
                                                     style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Logo:</label>
                                            <input type="file" name="header_logo" class="form-control" accept="image/*">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Logo Alt Text:</label>
                                            @foreach($languages as $language)
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">{{ strtoupper($language->lang_code) }}</span>
                                                <input type="text" name="header_logo_alt_{{ $language->lang_code }}" class="form-control" 
                                                       value="{{ $settings->getTranslation('header_logo_alt', $language->lang_code) }}" 
                                                       placeholder="Alt text in {{ $language->title }}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Logo --}}
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Footer Logo</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($settings->footer_logo)
                                            <div class="mb-3">
                                                <label class="form-label">Current Logo:</label>
                                                <img src="{{ asset('storage/' . $settings->footer_logo) }}" 
                                                     alt="Footer Logo" 
                                                     class="img-thumbnail" 
                                                     style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Logo:</label>
                                            <input type="file" name="footer_logo" class="form-control" accept="image/*">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Logo Alt Text:</label>
                                            @foreach($languages as $language)
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">{{ strtoupper($language->lang_code) }}</span>
                                                <input type="text" name="footer_logo_alt_{{ $language->lang_code }}" class="form-control" 
                                                       value="{{ $settings->getTranslation('footer_logo_alt', $language->lang_code) }}" 
                                                       placeholder="Alt text in {{ $language->title }}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 