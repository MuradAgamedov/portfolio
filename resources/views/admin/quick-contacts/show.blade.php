@extends('admin.layouts.master')

@section('title', 'Sürətli Əlaqə - Mesaj Detalları')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sürətli Əlaqə Mesajı</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.quick-contacts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Geri
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Mesaj Məzmunu</h5>
                                </div>
                                <div class="card-body">
                                    <div class="message-content">
                                        {!! nl2br(e($quickContact->message)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Mesaj Məlumatları</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>ID:</strong></td>
                                            <td>{{ $quickContact->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ad:</strong></td>
                                            <td>{{ $quickContact->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telefon:</strong></td>
                                            <td>
                                                <a href="tel:{{ $quickContact->phone }}" class="text-primary">
                                                    {{ $quickContact->phone }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($quickContact->is_read)
                                                    <span class="badge badge-success">Oxunub</span>
                                                @else
                                                    <span class="badge badge-warning">Oxunmayıb</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Göndərilmə tarixi:</strong></td>
                                            <td>{{ $quickContact->created_at->format('d.m.Y H:i:s') }}</td>
                                        </tr>
                                        @if($quickContact->updated_at != $quickContact->created_at)
                                            <tr>
                                                <td><strong>Son yenilənmə:</strong></td>
                                                <td>{{ $quickContact->updated_at->format('d.m.Y H:i:s') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Əməliyyatlar</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.quick-contacts.toggle-read', $quickContact->id) }}" 
                                          method="POST" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-secondary btn-block">
                                            @if($quickContact->is_read)
                                                <i class="fas fa-eye-slash"></i> Oxunmayıb kimi qeyd et
                                            @else
                                                <i class="fas fa-eye"></i> Oxunub kimi qeyd et
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.quick-contacts.destroy', $quickContact->id) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Bu mesajı silmək istədiyinizə əminsiniz?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="fas fa-trash"></i> Mesajı Sil
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.message-content {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
    font-size: 16px;
    line-height: 1.6;
    white-space: pre-wrap;
}
</style>
@endsection 