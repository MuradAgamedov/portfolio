@extends('admin.layouts.master')

@section('title', 'Pricing Plan Features')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Features for: {{ $pricingPlan->getTranslation('title', 'en') }}</h4>
                        <small class="text-muted">{{ $pricingPlan->getTranslation('title', 'az') }}</small>
                    </div>
                    <div>
                        <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Plans
                        </a>
                        <a href="{{ route('admin.pricing-plans.features.create', $pricingPlan) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Feature
                        </a>
                    </div>
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
                                    <th width="100">Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-features">
                                @foreach($features as $feature)
                                <tr data-id="{{ $feature->id }}">
                                    <td>
                                        <i class="fas fa-grip-vertical handle" style="cursor: move;"></i>
                                        {{ $feature->order }}
                                    </td>
                                    <td>
                                        <strong>{{ $feature->getTranslation('title', 'en') }}</strong><br>
                                        <small class="text-muted">{{ $feature->getTranslation('title', 'az') }}</small>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                   data-id="{{ $feature->id }}"
                                                   {{ $feature->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pricing-plans.features.edit', [$pricingPlan, $feature]) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pricing-plans.features.destroy', [$pricingPlan, $feature]) }}" 
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
    const sortable = new Sortable(document.getElementById('sortable-features'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            const orders = [];
            $('#sortable-features tr').each(function(index) {
                orders.push($(this).data('id'));
            });
            
            $.ajax({
                url: '{{ route("admin.pricing-plans.features.reorder", $pricingPlan) }}',
                method: 'POST',
                data: {
                    orders: orders,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update order numbers
                        $('#sortable-features tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });
                    }
                }
            });
        }
    });

    // Status Toggle
    $('.status-toggle').change(function() {
        const featureId = $(this).data('id');
        const isChecked = $(this).is(':checked');
        
        $.ajax({
            url: `/admin/pricing-plans/{{ $pricingPlan->id }}/features/${featureId}/toggle-status`,
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