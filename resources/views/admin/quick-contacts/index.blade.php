@extends('admin.layouts.master')

@section('title', 'Sürətli Əlaqə')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sürətli Əlaqə Mesajları</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>Telefon</th>
                                    <th>Mesaj</th>
                                    <th>Status</th>
                                    <th>Tarix</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quickContacts as $contact)
                                    <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>
                                            {{ Str::limit($contact->message, 50) }}
                                        </td>
                                        <td>
                                            @if($contact->is_read)
                                                <span class="badge badge-success">Oxunub</span>
                                            @else
                                                <span class="badge badge-warning">Oxunmayıb</span>
                                            @endif
                                        </td>
                                        <td>{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.quick-contacts.show', $contact->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Bax
                                            </a>
                                            
                                            <form action="{{ route('admin.quick-contacts.toggle-read', $contact->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    @if($contact->is_read)
                                                        <i class="fas fa-eye-slash"></i> Oxunmayıb kimi qeyd et
                                                    @else
                                                        <i class="fas fa-eye"></i> Oxunub kimi qeyd et
                                                    @endif
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.quick-contacts.destroy', $contact->id) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Bu mesajı silmək istədiyinizə əminsiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Sil
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Hələ heç bir sürətli əlaqə mesajı yoxdur.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($quickContacts->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $quickContacts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 