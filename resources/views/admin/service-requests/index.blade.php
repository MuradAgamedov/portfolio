@extends('admin.layouts.master')

@section('title', 'Service Requests')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service Requests</h3>
                </div>
                <div class="card-body">
                    @if($serviceRequests->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 60px;">ID</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col" class="text-center" style="width: 100px;">Status</th>
                                        <th scope="col" class="text-center" style="width: 120px;">Date</th>
                                        <th scope="col" class="text-center" style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceRequests as $request)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $request->id }}</td>
                                        <td class="fw-semibold">{{ $request->service ? $request->service->getTitle() : '' }}</td>
                                        <td>
                                            <a href="mailto:{{ $request->email }}" class="text-decoration-none">
                                                {{ $request->email }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($request->phone)
                                                <a href="tel:{{ $request->phone }}" class="text-decoration-none">
                                                    {{ $request->phone }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($request->subject, 50) }}</td>
                                        <td class="text-center">{!! $request->status_badge !!}</td>
                                        <td class="text-center text-muted">
                                            <small>{{ $request->created_at->format('d.m.Y H:i') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Service request actions">
                                                <a href="{{ route('admin.service-requests.show', $request) }}" 
                                                   class="btn btn-sm btn-info" title="View Request">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($request->isUnread())
                                                <form action="{{ route('admin.service-requests.mark-as-read', $request) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Mark as Read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('admin.service-requests.destroy', $request) }}" 
                                                      method="POST" style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this service request?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete Request">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination with Bootstrap 5 -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $serviceRequests->firstItem() ?? 0 }} to {{ $serviceRequests->lastItem() ?? 0 }} of {{ $serviceRequests->total() }} results
                            </div>
                            <div>
                                {{ $serviceRequests->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x text-muted"></i>
                            </div>
                            <h4 class="text-muted">No service requests found</h4>
                            <p class="text-muted">Service requests will appear here when users submit them.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 