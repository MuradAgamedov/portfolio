<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use App\Models\Language;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateLanguageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:generate {--force : Force regenerate all files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate language files from dictionary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dil faylları yaradılır...');

        $languages = Language::where('status', true)->orderBy('order')->get();
        $dictionaries = Dictionary::where('status', true)->orderBy('order')->get();

        if ($dictionaries->isEmpty()) {
            $this->warn('Heç bir aktiv tərcümə tapılmadı!');
            return;
        }

        $this->info("{$languages->count()} dil və {$dictionaries->count()} tərcümə tapıldı.");

        foreach ($languages as $language) {
            $this->info("Dil: {$language->name} ({$language->lang_code})");
            
            $langCode = $language->lang_code;
            $langPath = resource_path('lang/' . $langCode);
            
            // Create language directory if not exists
            if (!File::exists($langPath)) {
                File::makeDirectory($langPath, 0755, true);
                $this->line("  ✓ Dizin yaradıldı: {$langPath}");
            }

            // Group dictionaries by their group
            $groupedDictionaries = $dictionaries->groupBy('group');
            
            foreach ($groupedDictionaries as $group => $groupDictionaries) {
                $filename = $group ?: 'common';
                $filePath = $langPath . '/' . $filename . '.php';
                
                $translations = [];
                foreach ($groupDictionaries as $dictionary) {
                    $value = $dictionary->getValue($langCode);
                    if ($value) {
                        $translations[$dictionary->keyword] = $value;
                    }
                }
                
                // Write to file
                if (!empty($translations)) {
                    $content = '<?php return ' . var_export($translations, true) . ';';
                    File::put($filePath, $content);
                    $this->line("  ✓ Fayl yaradıldı: {$filename}.php ({$groupDictionaries->count()} tərcümə)");
                }
            }

            // Generate JSON file for dynamic translations
            $jsonTranslations = [];
            foreach ($dictionaries as $dictionary) {
                $value = $dictionary->getValue($langCode);
                if ($value) {
                    $jsonTranslations[$dictionary->keyword] = $value;
                }
            }
            
            $jsonPath = resource_path('lang/' . $langCode . '.json');
            File::put($jsonPath, json_encode($jsonTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->line("  ✓ JSON fayl yaradıldı: {$langCode}.json ({$dictionaries->count()} tərcümə)");
        }

        $this->info('Bütün dil faylları uğurla yaradıldı!');
        
        // Show usage instructions
        $this->newLine();
        $this->info('İstifadə təlimatları:');
        $this->line('1. Blade fayllarında: {{ __("keyword") }} və ya {{ __("group.keyword") }}');
        $this->line('2. JavaScript-də: window.translations["keyword"]');
        $this->line('3. Controller-də: Dictionary::translate("keyword")');
    }
}
