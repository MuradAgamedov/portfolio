<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroData;
use App\Models\Language;
use App\Services\ImageService;

class HeroDataController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Show the form for editing hero data
     */
    public function edit()
    {
        $heroData = HeroData::first();
        $languages = Language::where('status', true)->orderBy('order')->get();

        if (!$heroData) {
            $heroData = HeroData::create([
                'title' => ['az' => 'Başlıq', 'en' => 'Title', 'ru' => 'Заголовок'],
                'label' => ['az' => 'Etiket', 'en' => 'Label', 'ru' => 'Метка'],
                'text' => ['az' => 'Mətn', 'en' => 'Text', 'ru' => 'Текст'],
                'image_alt' => ['az' => 'Şəkil alt mətni', 'en' => 'Image alt text', 'ru' => 'Альтернативный текст изображения']
            ]);
        }

        return view('admin.hero.edit', compact('heroData', 'languages'));
    }

    /**
     * Update hero data
     */
    public function update(Request $request)
    {
        $heroData = HeroData::firstOrFail();
        $languages = Language::where('status', true)->orderBy('order')->get();

        // Build validation rules dynamically based on available languages
        $validationRules = [
            'title' => 'required|array',
            'label' => 'required|array',
            'text' => 'required|array',
            'image_alt' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];

        foreach ($languages as $language) {
            $langCode = $language->lang_code;
            $validationRules["title.{$langCode}"] = 'required|string|max:255';
            $validationRules["label.{$langCode}"] = 'required|string|max:255';
            $validationRules["text.{$langCode}"] = 'required|string';
            $validationRules["image_alt.{$langCode}"] = 'required|string|max:255';
        }

        $request->validate($validationRules);

        $data = $request->only(['title', 'label', 'text', 'image_alt']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->updateImage(
                $request->file('image'),
                $heroData->image,
                'hero'
            );
        }

        $heroData->update($data);

        return redirect()->route('admin.hero.edit')->with('success', 'Hero məlumatları uğurla yeniləndi!');
    }
}
