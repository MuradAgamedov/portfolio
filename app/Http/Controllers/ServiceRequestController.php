<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Service;
use App\Traits\RecaptchaTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceRequestController extends Controller
{
    use RecaptchaTrait;
    public function store(Request $request): JsonResponse
    {
        // Validate reCAPTCHA first
        if (!$this->validateRecaptcha($request)) {
            return response()->json([
                'success' => false,
                'message' => __('Please complete the reCAPTCHA verification.')
            ], 422);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        try {
            $serviceRequest = ServiceRequest::create([
                'service_id' => $request->service_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => __('Service request submitted successfully!'),
                'data' => $serviceRequest
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('An error occurred while submitting your request.'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $serviceRequests = ServiceRequest::with('service')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $pendingCount = ServiceRequest::where('status', 'pending')->count();

        return view('admin.service-requests.index', compact('serviceRequests', 'pendingCount'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        return view('admin.service-requests.show', compact('serviceRequest'));
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $serviceRequest->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => __('Status updated successfully!'),
            'data' => $serviceRequest
        ]);
    }

    public function markAsRead(ServiceRequest $serviceRequest)
    {
        $serviceRequest->update(['status' => 'read']);

        return redirect()->back()
            ->with('success', 'Service request marked as read.');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'Service request deleted successfully.');
    }
}
