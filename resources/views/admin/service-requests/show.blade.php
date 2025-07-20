@extends('admin.layouts.master')

@section('title', 'Service Request Details')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Service Request Details</h4>
                    <a href="{{ route('admin.service-requests.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Service</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->service ? $serviceRequest->service->getTitle() : 'N/A' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->email }}</dd>

                        <dt class="col-sm-4">Phone</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->phone ?: 'N/A' }}</dd>

                        <dt class="col-sm-4">Subject</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->subject }}</dd>

                        <dt class="col-sm-4">Message</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->message }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{!! $serviceRequest->status_badge !!}</dd>

                        <dt class="col-sm-4">Date</dt>
                        <dd class="col-sm-8">{{ $serviceRequest->created_at->format('d.m.Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 