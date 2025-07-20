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
                                        <td>{{ $request->service_name }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->phone ?: 'N/A' }}</td>
                                        <td>{{ Str::limit($request->subject, 50) }}</td>
                                        <td>{!! $request->status_badge !!}</td>
                                        <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.service-requests.show', $request) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="updateStatus({{ $request->id }})">
                                                <i class="fas fa-edit"></i> Status
                                            </button>
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

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveStatus()">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentRequestId = null;

function updateStatus(requestId) {
    currentRequestId = requestId;
    $('#statusModal').modal('show');
}

function saveStatus() {
    if (!currentRequestId) return;
    
    const status = document.getElementById('status').value;
    
    fetch(`/admin/service-requests/${currentRequestId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#ff014f'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: data.message || 'An error occurred.',
                confirmButtonColor: '#ff014f'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while updating status.',
            confirmButtonColor: '#ff014f'
        });
    })
    .finally(() => {
        $('#statusModal').modal('hide');
    });
}
</script>
@endpush 