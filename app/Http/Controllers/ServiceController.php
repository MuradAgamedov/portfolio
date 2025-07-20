<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)
                          ->orderBy('order', 'asc')
                          ->get();
        
        return view('front.services.index', compact('services'));
    }


} 