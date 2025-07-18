<?php

namespace App\Http\Controllers;

use App\Models\HeroData;
use App\Models\HeroProfession;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Social;
use App\Models\About;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $data = [
            'heroData' => HeroData::first(),
            'heroProfessions' => HeroProfession::orderBy('order')->get(),
            'services' => Service::orderBy('order')->get(),
            'portfolios' => Portfolio::with('category')->orderBy('order')->get(),
            'portfolioCategories' => PortfolioCategory::orderBy('order')->get(),
            'education' => Education::orderBy('order')->get(),
            'experiences' => Experience::orderBy('order')->get(),
            'skills' => Skill::orderBy('order')->get(),
            'socials' => Social::first(),
            'about' => About::first(),
        ];

        return view('front.home.index', $data);
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Here you can add logic to send email or save to database
        // For now, we'll just redirect back with success message
        
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
} 