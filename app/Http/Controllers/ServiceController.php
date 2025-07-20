<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
                          ->orderBy('order', 'asc')
                          ->get();
        
        return view('front.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)
                         ->where('is_active', true)
                         ->firstOrFail();
        
        $services = Service::where('is_active', true)
                          ->where('id', '!=', $service->id)
                          ->orderBy('order', 'asc')
                          ->get();
        
        return view('front.services.show', compact('service', 'services'));
    }
} 