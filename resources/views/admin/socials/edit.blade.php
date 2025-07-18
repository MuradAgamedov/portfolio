@extends('admin.layouts.master')

@section('title', 'Sosial Şəbəkələr')

@section('styles')
<style>
.social-card {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.social-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    margin-right: 15px;
}

.social-info {
    flex: 1;
}

.social-name {
    font-weight: 600;
    margin-bottom: 5px;
}

.social-url {
    font-size: 0.9rem;
    color: #6c757d;
    word-break: break-all;
}

.platform-select {
    min-width: 120px;
    max-width: 150px;
}

.url-input {
    flex: 1;
    min-width: 200px;
}

.status-toggle {
    margin-left: 10px;
    white-space: nowrap;
}

.social-card .d-flex {
    flex-wrap: wrap;
    gap: 10px;
}

.social-card .d-flex > div:last-child {
    flex: 1;
    min-width: 300px;
    display: flex;
    align-items: center;
    gap: 10px;
}

@media (max-width: 768px) {
    .social-card .d-flex > div:last-child {
        min-width: 100%;
        flex-direction: column;
        align-items: stretch;
    }
    
    .platform-select,
    .url-input {
        width: 100%;
        margin-bottom: 10px;
    }
}

.empty-state {
    text-align: center;
    padding: 40px;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-share-alt"></i> Sosial Şəbəkələr
            </h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sosial Şəbəkə Linkləri</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.socials.update') }}" method="POST" id="socialsForm">
                @csrf
                @method('PUT')

                <div id="socialsContainer">
                    @if($socials->count() > 0)
                        @foreach($socials as $index => $social)
                        <div class="social-card" data-index="{{ $index }}">
                            <div class="d-flex align-items-center">
                                <div class="social-icon" style="background-color: {{ $platforms[$social->platform]['color'] ?? '#007bff' }}">
                                    <i class="{{ $social->icon }}"></i>
                                </div>
                                <div class="social-info">
                                    <div class="social-name">{{ $platforms[$social->platform]['name'] ?? $social->platform }}</div>
                                    <div class="social-url">{{ $social->url }}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <select name="socials[{{ $index }}][platform]" class="form-select platform-select">
                                        @foreach($platforms as $key => $platform)
                                            <option value="{{ $key }}" {{ $social->platform == $key ? 'selected' : '' }}>
                                                {{ $platform['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="url" name="socials[{{ $index }}][url]" value="{{ $social->url }}" 
                                           class="form-control url-input" placeholder="https://example.com">
                                    <div class="form-check status-toggle">
                                        <input class="form-check-input" type="checkbox" 
                                               name="socials[{{ $index }}][status]" 
                                               {{ $social->status ? 'checked' : '' }}>
                                        <label class="form-check-label">Aktiv</label>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-social">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="fas fa-share-alt"></i>
                            <h5>Hələ sosial şəbəkə əlavə edilməyib</h5>
                            <p>Yeni sosial şəbəkə əlavə etmək üçün aşağıdakı düyməni istifadə edin</p>
                        </div>
                    @endif
                </div>

                <div class="mt-3">
                    <button type="button" class="btn btn-success" id="addSocial">
                        <i class="fas fa-plus"></i> Sosial Şəbəkə Əlavə Et
                    </button>
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
    var socialIndex = {{ $socials->count() }};
    var platforms = @json($platforms);

    // Add new social
    $('#addSocial').on('click', function() {
        var socialCard = `
            <div class="social-card" data-index="${socialIndex}">
                <div class="d-flex align-items-center">
                    <div class="social-icon" style="background-color: #007bff">
                        <i class="fab fa-plus"></i>
                    </div>
                    <div class="social-info">
                        <div class="social-name">Yeni Sosial Şəbəkə</div>
                        <div class="social-url">URL daxil edin</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <select name="socials[${socialIndex}][platform]" class="form-select platform-select">
                            <option value="">Seçin</option>
                            ${Object.keys(platforms).map(key => 
                                `<option value="${key}">${platforms[key].name}</option>`
                            ).join('')}
                        </select>
                        <input type="url" name="socials[${socialIndex}][url]" 
                               class="form-control url-input" placeholder="https://example.com">
                        <div class="form-check status-toggle">
                            <input class="form-check-input" type="checkbox" 
                                   name="socials[${socialIndex}][status]" checked>
                            <label class="form-check-label">Aktiv</label>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger remove-social">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('#socialsContainer').append(socialCard);
        socialIndex++;
        
        // Hide empty state if exists
        $('.empty-state').hide();
    });

    // Remove social
    $(document).on('click', '.remove-social', function() {
        $(this).closest('.social-card').remove();
        
        // Show empty state if no socials left
        if ($('.social-card').length === 0) {
            $('#socialsContainer').html(`
                <div class="empty-state">
                    <i class="fas fa-share-alt"></i>
                    <h5>Hələ sosial şəbəkə əlavə edilməyib</h5>
                    <p>Yeni sosial şəbəkə əlavə etmək üçün aşağıdakı düyməni istifadə edin</p>
                </div>
            `);
        }
    });

    // Update icon and color when platform changes
    $(document).on('change', '.platform-select', function() {
        var platform = $(this).val();
        var socialCard = $(this).closest('.social-card');
        var iconDiv = socialCard.find('.social-icon');
        var nameDiv = socialCard.find('.social-name');
        
        if (platform && platforms[platform]) {
            iconDiv.css('background-color', platforms[platform].color);
            iconDiv.html(`<i class="${platforms[platform].icon}"></i>`);
            nameDiv.text(platforms[platform].name);
        } else {
            iconDiv.css('background-color', '#6c757d');
            iconDiv.html('<i class="fas fa-question"></i>');
            nameDiv.text('Bilinməyən Platform');
        }
    });

    // Update URL display
    $(document).on('input', '.url-input', function() {
        var url = $(this).val();
        var socialCard = $(this).closest('.social-card');
        var urlDiv = socialCard.find('.social-url');
        
        if (url) {
            urlDiv.text(url);
        } else {
            urlDiv.text('URL daxil edin');
        }
    });
});
</script>
@endsection 