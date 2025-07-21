<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Traits\SocialTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use SocialTrait;

    public function index()
    {
        $services = Service::where('status', 1)
                          ->orderBy('order', 'asc')
                          ->get();
        
        $socials = $this->getSocials();
        
        return view('front.services.index', compact('services', 'socials'));
    }


} 