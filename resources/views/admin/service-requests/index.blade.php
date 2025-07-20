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
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceRequests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->service ? $request->service->getTitle() : '' }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->phone ?: 'N/A' }}</td>
                                        <td>{{ Str::limit($request->subject, 50) }}</td>
                                        <td>{!! $request->status_badge !!}</td>
                                        <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.service-requests.show', $request) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                @if($request->isUnread())
                                                <form action="{{ route('admin.service-requests.mark-as-read', $request) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-check"></i> Mark Read
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('admin.service-requests.destroy', $request) }}" 
                                                      method="POST" style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this service request?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {{ $serviceRequests->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No service requests found</h5>
                            <p class="text-muted">Service requests will appear here when users submit them.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 