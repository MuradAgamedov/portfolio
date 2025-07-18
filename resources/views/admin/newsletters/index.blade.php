@extends('admin.layouts.master')

@section('title', 'Newsletter Subscriptions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Newsletter Subscriptions</h4>
                    <p class="card-subtitle">Manage newsletter email subscriptions</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Subscribed At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($newsletters as $newsletter)
                                <tr>
                                    <td>{{ $newsletter->id }}</td>
                                    <td>{{ $newsletter->email }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-status" 
                                                   type="checkbox" 
                                                   data-id="{{ $newsletter->id }}"
                                                   {{ $newsletter->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $newsletter->subscribed_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-newsletter" 
                                                data-id="{{ $newsletter->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No newsletter subscriptions found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $newsletters->links() }}
                    </div>
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