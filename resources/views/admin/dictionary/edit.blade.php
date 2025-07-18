@extends('admin.layouts.master')

@section('title', 'Tərcüməni Redaktə Et')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-edit"></i> Tərcüməni Redaktə Et
                </h1>
                <a href="{{ route('admin.dictionary.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Geri
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tərcümə Məlumatları</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dictionary.update', $dictionary) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="keyword" class="form-label">
                        Açar Söz <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('keyword') is-invalid @enderror" 
                           id="keyword" 
                           name="keyword" 
                           value="{{ old('keyword', $dictionary->keyword) }}" 
                           placeholder="məsələn: welcome_message"
                           required>
                    <div class="form-text">
                        Açar söz unikal olmalıdır və kiçik hərflərlə yazılmalıdır
                    </div>
                    @error('keyword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tərcümələr <span class="text-danger">*</span></label>
                    <div class="row">
                        @foreach($languages as $language)
                            <div class="col-md-6 mb-3">
                                <label for="values_{{ $language->lang_code }}" class="form-label">
                                    {{ $language->title }} ({{ strtoupper($language->lang_code) }})
                                </label>
                                <textarea class="form-control @error('values.' . $language->lang_code) is-invalid @enderror" 
                                          id="values_{{ $language->lang_code }}" 
                                          name="values[{{ $language->lang_code }}]" 
                                          rows="3" 
                                          placeholder="{{ $language->title }} dilində tərcümə..."
                                          required>{{ old('values.' . $language->lang_code, $dictionary->getValue($language->lang_code)) }}</textarea>
                                @error('values.' . $language->lang_code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.dictionary.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times"></i> Ləğv et
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Yenilə
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 