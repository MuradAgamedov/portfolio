<?php

namespace App\Http\Controllers;

use App\Models\HeroData;
use App\Models\HeroProfession;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Certificate;
use App\Models\PortfolioCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Social;
use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $data = [
            'heroData' => HeroData::firstOrCreate(),
            'heroProfessions' => HeroProfession::where('status', true)->orderBy('order')->get(),
            'services' => Service::where('status', true)->orderBy('order')->get(),
            'portfolios' => Portfolio::with('category')->where('status', true)->orderBy('order')->get(),
            'portfolioCategories' => PortfolioCategory::orderBy('order')->get(),
            'education' => Education::where('status', true)->orderBy('order')->get(),
            'experiences' => Experience::where('status', true)->orderBy('order')->get(),
            'skills' => Skill::where('status', true)->orderBy('order')->get(),
            'socials' => Social::where('status', true)->orderBy('order')->get(),
            'certificates' => Certificate::where('status', true)->orderBy('order')->get(),
            'about' => About::firstOrCreate(),
            'blogs' => Blog::where('status', true)->orderBy('published_at', 'desc')->get(),
            'pricingPlans' => PricingPlan::with('activeFeatures')->where('status', true)->orderBy('order')->get(),
        ];
        
        return view('front.home.index', $data);
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'contact-name' => 'required|string|max:255',
            'contact-email' => 'required|email|max:255',
            'contact-phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'contact-message' => 'required|string|max:1000',
        ]);

        // Save contact message to database
        Contact::create([
            'name' => $validated['contact-name'],
            'email' => $validated['contact-email'],
            'phone' => $validated['contact-phone'],
            'subject' => $validated['subject'],
            'message' => $validated['contact-message'],
        ]);

        // Check if request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
