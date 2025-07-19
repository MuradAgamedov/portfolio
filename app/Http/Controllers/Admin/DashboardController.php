<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Newsletter;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalServices = Service::count();
        $totalPortfolios = Portfolio::count();
        $totalBlogs = Blog::count();
        $totalContacts = Contact::count();
        $totalEducation = Education::count();
        $totalExperience = Experience::count();
        $totalSkills = Skill::count();
        $totalCertificates = Certificate::count();
        $totalNewsletters = Newsletter::count();
        $totalLanguages = Language::count();

        // Recent data
        $recentServices = Service::latest()->take(5)->get();
        $recentPortfolios = Portfolio::latest()->take(5)->get();
        $recentBlogs = Blog::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        // Unread contacts
        $unreadContacts = Contact::unread()->count();

        // Monthly statistics
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $monthlyServices = Service::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->count();
        $monthlyPortfolios = Portfolio::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->count();
        $monthlyBlogs = Blog::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->count();
        $monthlyContacts = Contact::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->count();

        // Status statistics
        $activeServices = Service::where('status', 1)->count();
        $activePortfolios = Portfolio::where('status', 1)->count();
        $activeBlogs = Blog::where('status', 1)->count();
        $activeSkills = Skill::where('status', 1)->count();

        // Chart data for last 6 months
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartData[] = [
                'month' => $month->format('M'),
                'services' => Service::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)->count(),
                'portfolios' => Portfolio::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)->count(),
                'blogs' => Blog::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)->count(),
                'contacts' => Contact::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'totalServices', 'totalPortfolios', 'totalBlogs', 'totalContacts',
            'totalEducation', 'totalExperience', 'totalSkills', 'totalCertificates',
            'totalNewsletters', 'totalLanguages', 'recentServices', 'recentPortfolios',
            'recentBlogs', 'recentContacts', 'unreadContacts', 'monthlyServices',
            'monthlyPortfolios', 'monthlyBlogs', 'monthlyContacts', 'activeServices',
            'activePortfolios', 'activeBlogs', 'activeSkills', 'chartData'
        ));
    }
}
