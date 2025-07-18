<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class CreateLanguageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'languages:create-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create language files for existing languages in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $languages = Language::all();
        
        if ($languages->isEmpty()) {
            $this->error('Heç bir dil tapılmadı!');
            return 1;
        }

        $this->info('Dil faylları yaradılır...');

        foreach ($languages as $language) {
            $this->createLanguageFiles($language->lang_code);
            $this->info("✓ {$language->title} ({$language->lang_code}) faylları yaradıldı");
        }

        $this->info('Bütün dil faylları uğurla yaradıldı!');
        return 0;
    }

    /**
     * Create language directory and files
     */
    private function createLanguageFiles($langCode)
    {
        $langPath = resource_path('lang/' . $langCode);
        
        // Create language directory
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true);
        }

        // Create default JSON file
        $jsonPath = resource_path('lang/' . $langCode . '.json');
        if (!File::exists($jsonPath)) {
            File::put($jsonPath, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        // Create default translation files
        $defaultFiles = [
            'auth.php' => [
                'failed' => 'Bu məlumatlar bizim qeydlərimizlə uyğun gəlmir.',
                'password' => 'Təqdim edilən şifrə yanlışdır.',
                'throttle' => 'Çox sayda giriş cəhdi. Zəhmət olmasa :seconds saniyə sonra yenidən cəhd edin.',
            ],
            'pagination.php' => [
                'previous' => '&laquo; Əvvəlki',
                'next' => 'Sonrakı &raquo;',
            ],
            'passwords.php' => [
                'reset' => 'Şifrəniz yeniləndi!',
                'sent' => 'Şifrə yeniləmə linkini e-poçt ünvanınıza göndərdik!',
                'throttled' => 'Zəhmət olmasa yenidən cəhd etmədən əvvəl gözləyin.',
                'token' => 'Şifrə yeniləmə kodu yanlışdır.',
                'user' => 'Bu e-poçt ünvanı ilə istifadəçi tapılmadı.',
            ],
            'validation.php' => [
                'accepted' => ':attribute qəbul edilməlidir.',
                'required' => ':attribute sahəsi tələb olunur.',
                'email' => ':attribute düzgün e-poçt ünvanı olmalıdır.',
                'unique' => ':attribute artıq götürülüb.',
                'min' => [
                    'string' => ':attribute ən azı :min simvol olmalıdır.',
                ],
                'max' => [
                    'string' => ':attribute :max simvoldan çox ola bilməz.',
                ],
                'attributes' => [
                    'name' => 'ad',
                    'email' => 'e-poçt',
                    'password' => 'şifrə',
                    'title' => 'başlıq',
                    'description' => 'təsvir',
                ],
            ],
        ];

        foreach ($defaultFiles as $filename => $content) {
            $filePath = $langPath . '/' . $filename;
            if (!File::exists($filePath)) {
                File::put($filePath, '<?php return ' . var_export($content, true) . ';');
            }
        }
    }
}
