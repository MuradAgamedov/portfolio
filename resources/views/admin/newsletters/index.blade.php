@extends('admin.layouts.master')

@section('title', 'Newsletter Subscriptions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Newsletter Subscriptions</h3>
                </div>
                <div class="card-body">
                    @if($newsletters->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 60px;">ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center" style="width: 120px;">Status</th>
                                    <th scope="col" class="text-center" style="width: 150px;">Subscribed Date</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($newsletters as $newsletter)
                                <tr>
                                    <td class="text-center fw-bold">{{ $newsletter->id }}</td>
                                    <td>
                                        <a href="mailto:{{ $newsletter->email }}" class="text-decoration-none">
                                            {{ $newsletter->email }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input class="form-check-input toggle-status" type="checkbox" 
                                                   data-id="{{ $newsletter->id }}"
                                                   {{ $newsletter->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted">
                                        <small>{{ $newsletter->subscribed_at->format('d.m.Y H:i') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm delete-newsletter" 
                                                data-id="{{ $newsletter->id }}"
                                                title="Delete Subscription">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-envelope fa-2x mb-2"></i>
                                            <p>No newsletter subscriptions found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination with Bootstrap 5 -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $newsletters->firstItem() ?? 0 }} to {{ $newsletters->lastItem() ?? 0 }} of {{ $newsletters->total() }} results
                        </div>
                        <div>
                            {{ $newsletters->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-envelope fa-3x text-muted"></i>
                        </div>
                        <h4 class="text-muted">No newsletter subscriptions found</h4>
                        <p class="text-muted">When someone subscribes to the newsletter, they will appear here.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Toggle Status
    $('.toggle-status').change(function() {
        const id = $(this).data('id');
        const isChecked = $(this).is(':checked');
        
        $.ajax({
            url: `/admin/newsletters/${id}/toggle-status`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong!'
                });
            }
        });
    });

    // Delete Newsletter
    $('.delete-newsletter').click(function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/newsletters/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong!'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection 