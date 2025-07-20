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
use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\PricingPlan;
use App\Models\Newsletter;
use App\Traits\RecaptchaTrait;
use App\Traits\SocialTrait;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    use RecaptchaTrait, SocialTrait;

    public function index()
    {
        $data = [
            'heroData' => HeroData::firstOrCreate(),
            'heroProfessions' => HeroProfession::where('status', true)->orderBy('order')->get(),
            'services' => Service::where('status', true)->orderBy('order')->get(),
            'portfolios' => Portfolio::with('category')->where('status', true)->orderBy('order')->limit(9)->get(),
            'portfolioCategories' => PortfolioCategory::orderBy('order')->get(),
            'education' => Education::where('status', true)->orderBy('order')->get(),
            'experiences' => Experience::where('status', true)->orderBy('order')->get(),
            'skills' => Skill::where('status', true)->orderBy('order')->get(),
            'socials' => $this->getSocials(),
            'certificates' => Certificate::where('status', true)->orderBy('order')->get(),
            'about' => About::firstOrCreate(),
            'blogs' => Blog::where('status', true)->orderBy('published_at', 'desc')->limit(6)->get(),
            'pricingPlans' => PricingPlan::with('activeFeatures')->where('status', true)->orderBy('order')->get(),
        ];
        
        return view('front.home.index', $data);
    }

    public function contact(Request $request)
    {
        // Validate reCAPTCHA first
        if (!$this->validateRecaptcha($request)) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __("Please complete the reCAPTCHA verification.")
                ], 422);
            }
            
            return redirect()->back()->withErrors(['recaptcha' => __("Please complete the reCAPTCHA verification.")]);
        }

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



    public function newsletter(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:newsletters,email'
            ], [
                'email.required' => 'Email ünvanı tələb olunur!',
                'email.email' => 'Zəhmət olmasa düzgün email ünvanı daxil edin!',
                'email.unique' => 'Bu email ünvanı artıq abunədir!'
            ]);

            Newsletter::create([
                'email' => $validated['email'],
                'status' => true,
                'subscribed_at' => now()
            ]);

            // Always return JSON for this endpoint
            return response()->json([
                'success' => true,
                'message' => 'Newsletter-ə uğurla abunə oldunuz!'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Always return JSON for this endpoint
            return response()->json([
                'success' => false,
                'message' => $e->errors()['email'][0] ?? 'Validation xətası!'
            ], 422);
        } catch (\Exception $e) {
            // Always return JSON for this endpoint
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.'
            ], 500);
        }
    }
}
