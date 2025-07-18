<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DictionaryController extends Controller
{
    /**
     * Display a listing of dictionary
     */
    public function index()
    {
        $dictionaries = Dictionary::all();
        return view('admin.dictionary.index', compact('dictionaries'));
    }

    /**
     * Show the form for creating a new dictionary
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.dictionary.create', compact('languages'));
    }

    /**
     * Store a newly created dictionary
     */
    public function store(Request $request)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'keyword' => 'required|string|max:255|unique:dictionaries,keyword',
        ];

        foreach ($languages as $language) {
            $rules["values.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        Dictionary::create($validated);

        // Generate language files after creating dictionary
        $this->generateLanguageFiles();

        return redirect()->route('admin.dictionary.index')
            ->with('success', 'Tərcümə uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing the specified dictionary
     */
    public function edit(Dictionary $dictionary)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        return view('admin.dictionary.edit', compact('dictionary', 'languages'));
    }

    /**
     * Update the specified dictionary
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        
        // Build validation rules
        $rules = [
            'keyword' => 'required|string|max:255|unique:dictionaries,keyword,' . $dictionary->id,
        ];

        foreach ($languages as $language) {
            $rules["values.{$language->lang_code}"] = 'required|string';
        }

        $validated = $request->validate($rules);

        $dictionary->update($validated);

        // Generate language files after updating dictionary
        $this->generateLanguageFiles();

        return redirect()->route('admin.dictionary.index')
            ->with('success', 'Tərcümə uğurla yeniləndi!');
    }

    /**
     * Remove the specified dictionary
     */
    public function destroy(Dictionary $dictionary)
    {
        $dictionary->delete();

        // Generate language files after deleting dictionary
        $this->generateLanguageFiles();

        return redirect()->route('admin.dictionary.index')
            ->with('success', 'Tərcümə uğurla silindi!');
    }

    /**
     * Generate language files from dictionary
     */
    private function generateLanguageFiles()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $dictionaries = Dictionary::all();

        foreach ($languages as $language) {
            $langCode = $language->lang_code;
            $langPath = resource_path('lang/' . $langCode);
            
            // Create language directory if not exists
            if (!File::exists($langPath)) {
                File::makeDirectory($langPath, 0755, true);
            }

            // Generate common.php file
            $filePath = $langPath . '/common.php';
            $translations = [];
            
            foreach ($dictionaries as $dictionary) {
                $value = $dictionary->getValue($langCode);
                if ($value) {
                    $translations[$dictionary->keyword] = $value;
                }
            }
            
            // Write to file
            if (!empty($translations)) {
                $content = '<?php return ' . var_export($translations, true) . ';';
                File::put($filePath, $content);
            }

            // Generate JSON file for dynamic translations
            $jsonPath = resource_path('lang/' . $langCode . '.json');
            File::put($jsonPath, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * Generate language files command
     */
    public function generateFiles()
    {
        $this->generateLanguageFiles();
        return redirect()->route('admin.dictionary.index')
            ->with('success', 'Dil faylları uğurla yeniləndi!');
    }
}
