@extends('admin.layouts.master')

@section('title', 'Pricing Plans')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Pricing Plans</h4>
                    <a href="{{ route('admin.pricing-plans.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Plan
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">Order</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th width="100">Status</th>
                                    <th width="200">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-pricing-plans">
                                @foreach($pricingPlans as $plan)
                                <tr data-id="{{ $plan->id }}">
                                    <td>
                                        <i class="fas fa-grip-vertical handle" style="cursor: move;"></i>
                                        {{ $plan->order }}
                                    </td>
                                    <td>
                                        <strong>{{ $plan->getTranslation('title', 'en') }}</strong><br>
                                        <small class="text-muted">{{ $plan->getTranslation('title', 'az') }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $plan->getTranslation('price', 'en') }}</strong><br>
                                        <small class="text-muted">{{ $plan->getTranslation('price', 'az') }}</small>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                   data-id="{{ $plan->id }}"
                                                   {{ $plan->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pricing-plans.features.index', $plan) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-list"></i> Features ({{ $plan->features->count() }})
                                        </a>
                                        <a href="{{ route('admin.pricing-plans.edit', $plan) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pricing-plans.destroy', $plan) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Drag and Drop Reordering
    const sortable = new Sortable(document.getElementById('sortable-pricing-plans'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            const orders = [];
            $('#sortable-pricing-plans tr').each(function(index) {
                orders.push($(this).data('id'));
            });
            
            $.ajax({
                url: '{{ route("admin.pricing-plans.reorder") }}',
                method: 'POST',
                data: {
                    orders: orders,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update order numbers
                        $('#sortable-pricing-plans tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });
                    }
                }
            });
        }
    });

    // Status Toggle
    $('.status-toggle').change(function() {
        const planId = $(this).data('id');
        const isChecked = $(this).is(':checked');
        
        $.ajax({
            url: `/admin/pricing-plans/${planId}/toggle-status`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Optional: Show success message
                }
            },
            error: function() {
                // Revert the toggle if failed
                $(this).prop('checked', !isChecked);
            }
        });
    });
});
</script>
@endpush
@endsection 