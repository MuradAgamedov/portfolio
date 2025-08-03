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
use App\Models\SiteSetting;
use App\Models\QuickContact;
use App\Traits\SocialTrait;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    use SocialTrait;

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
            'siteSettings' => SiteSetting::first(),
        ];
        
        return view('front.home.index', $data);
    }

    public function about()
    {
        $data = [
            'about' => About::firstOrCreate(),
            'education' => Education::where('status', true)->orderBy('order')->get(),
            'experiences' => Experience::where('status', true)->orderBy('order')->get(),
            'skills' => Skill::where('status', true)->orderBy('order')->get(),
            'socials' => $this->getSocials(),
        ];
        
        return view('front.about.index', $data);
    }

    public function contactPage()
    {
        $data = [
            'socials' => $this->getSocials(),
        ];
        
        return view('front.contact.index', $data);
    }

    public function contact(Request $request)
    {
        try {
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
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error: ' . implode(', ', $e->errors()),
                    'errors' => $e->errors()
                ], 422);
            }
            
            return redirect()->back()->withErrors($e->errors());
            
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving your message. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while saving your message. Please try again.');
        }
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

    /**
     * Get pricing plans for Load More functionality
     */
    public function getPricingPlans(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 3;
        $offset = ($page - 1) * $perPage;

        $pricingPlans = PricingPlan::with('activeFeatures')
            ->where('status', true)
            ->orderBy('order')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $totalPlans = PricingPlan::where('status', true)->count();
        $hasMore = ($offset + $perPage) < $totalPlans;

        $html = '';
        foreach ($pricingPlans as $index => $plan) {
            $actualIndex = $offset + $index;
            $html .= view('front.partials.pricing-card', [
                'plan' => $plan,
                'index' => $actualIndex,
                'isLoadMore' => true
            ])->render();
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'hasMore' => $hasMore,
            'currentPage' => $page,
            'totalPlans' => $totalPlans
        ]);
    }

    public function quickContact(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'message' => 'required|string|max:1000',
            ], [
                'name.required' => 'Ad tələb olunur!',
                'phone.required' => 'Telefon nömrəsi tələb olunur!',
                'message.required' => 'Mesaj tələb olunur!',
                'name.max' => 'Ad maksimum 255 simvol ola bilər!',
                'phone.max' => 'Telefon nömrəsi maksimum 20 simvol ola bilər!',
                'message.max' => 'Mesaj maksimum 1000 simvol ola bilər!'
            ]);

            QuickContact::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'message' => $validated['message'],
            ]);

            return response()->json([
                'success' => true,
                'message' => __('Mesajınız uğurla göndərildi!')
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()[array_key_first($e->errors())][0] ?? 'Validation xətası!'
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Quick Contact Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi! Zəhmət olmasa yenidən cəhd edin.'
            ], 500);
        }
    }
}
