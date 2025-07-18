<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;

class SocialController extends Controller
{
    /**
     * Show the form for editing social links
     */
    public function edit()
    {
        $socials = Social::orderBy('order')->get();
        $platforms = Social::getPlatforms();
        
        // Debug information
        \Log::info('Socials count: ' . $socials->count());
        \Log::info('All socials: ' . $socials->toJson());
        
        return view('admin.socials.edit', compact('socials', 'platforms'));
    }

    /**
     * Update social links
     */
    public function update(Request $request)
    {
        $request->validate([
            'socials' => 'required|array',
            'socials.*.platform' => 'required|string',
            'socials.*.url' => 'required|url',
        ]);

        try {
            // Delete existing socials
            Social::query()->delete();

            // Create new socials
            foreach ($request->socials as $index => $socialData) {
                if (!empty($socialData['url'])) {
                    $platforms = Social::getPlatforms();
                    $platform = $socialData['platform'];
                    
                    Social::create([
                        'platform' => $platform,
                        'url' => $socialData['url'],
                        'icon' => $platforms[$platform]['icon'] ?? null,
                        'status' => isset($socialData['status']),
                        'order' => $index
                    ]);
                }
            }

            return redirect()->route('admin.socials.edit')->with('success', 'Sosial şəbəkələr uğurla yeniləndi!');
        } catch (\Exception $e) {
            \Log::error('Social update error: ' . $e->getMessage());
            return redirect()->route('admin.socials.edit')->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
