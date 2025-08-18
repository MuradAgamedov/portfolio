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
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 60px;">ID</th>
                                    <th scope="col">Ad</th>
                                    <th scope="col">Telefon</th>
                                    <th scope="col">Mesaj</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Status</th>
                                    <th scope="col" class="text-center" style="width: 120px;">Tarix</th>
                                    <th scope="col" class="text-center" style="width: 250px;">Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quickContacts as $contact)
                                    <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                        <td class="text-center fw-bold">{{ $contact->id }}</td>
                                        <td class="fw-semibold">{{ $contact->name }}</td>
                                        <td>
                                            <a href="tel:{{ $contact->phone }}" class="text-decoration-none">
                                                {{ $contact->phone }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ Str::limit($contact->message, 50) }}
                                        </td>
                                        <td class="text-center">
                                            @if($contact->is_read)
                                                <span class="badge bg-success text-dark">Oxunub</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Oxunmayıb</span>
                                            @endif
                                        </td>
                                        <td class="text-center text-muted">
                                            <small>{{ $contact->created_at->format('d.m.Y H:i') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Quick contact actions">
                                                <a href="{{ route('admin.quick-contacts.show', $contact->id) }}" 
                                                   class="btn btn-sm btn-info" title="Bax">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.quick-contacts.toggle-read', $contact->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-secondary" title="Toggle read status">
                                                        @if($contact->is_read)
                                                            <i class="fas fa-eye-slash"></i>
                                                        @else
                                                            <i class="fas fa-eye"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.quick-contacts.destroy', $contact->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Bu mesajı silmək istədiyinizə əminsiniz?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Sil">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                                <p>Hələ heç bir sürətli əlaqə mesajı yoxdur.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($quickContacts->hasPages())
                        <!-- Pagination with Bootstrap 5 -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $quickContacts->firstItem() ?? 0 }} to {{ $quickContacts->lastItem() ?? 0 }} of {{ $quickContacts->total() }} results
                            </div>
                            <div>
                                {{ $quickContacts->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 