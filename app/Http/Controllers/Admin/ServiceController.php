<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Language;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $icons = Service::getIcons();
        return view('admin.services.create', compact('languages', 'icons'));
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon_alt_text' => 'required|array',
            'icon_alt_text.*' => 'required|string|max:255',
        ]);

        // Upload icon image
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services/icons', 'public');
        }

        $service = Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $iconPath,
            'icon_alt_text' => $request->icon_alt_text,
            'status' => $request->has('status'),
            'order' => Service::max('order') + 1
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Xidmət uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing a service
     */
    public function edit(Service $service)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $icons = Service::getIcons();
        return view('admin.services.edit', compact('service', 'languages', 'icons'));
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon_alt_text' => 'required|array',
            'icon_alt_text.*' => 'required|string|max:255',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'icon_alt_text' => $request->icon_alt_text,
            'status' => $request->has('status')
        ];

        // Upload new icon if provided
        if ($request->hasFile('icon')) {
            // Delete old icon
            if ($service->icon && \Storage::disk('public')->exists($service->icon)) {
                \Storage::disk('public')->delete($service->icon);
            }
            
            // Upload new icon
            $iconPath = $request->file('icon')->store('services/icons', 'public');
            $updateData['icon'] = $iconPath;
        }

        $service->update($updateData);

        return redirect()->route('admin.services.index')->with('success', 'Xidmət uğurla yeniləndi!');
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service)
    {
        // Delete icon file
        if ($service->icon && \Storage::disk('public')->exists($service->icon)) {
            \Storage::disk('public')->delete($service->icon);
        }
        
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Xidmət uğurla silindi!');
    }

    /**
     * Reorder services
     */
    public function reorder(Request $request)
    {
        \Log::info('Reorder request received', [
            'orders' => $request->orders,
            'all_data' => $request->all()
        ]);

        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:services,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Service::where('id', $item['id'])->update(['order' => $item['order']]);
            \Log::info("Updated service {$item['id']} to order {$item['order']}");
        }

        \Log::info('Reorder completed successfully');
        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }
} 