<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::orderBy('order')->get();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'lang_code' => 'required|string|max:10|unique:languages,lang_code',
        ]);
        

        $data = [
            'title' => $request->title,
            'lang_code' => $request->lang_code,
            'is_main_lang' => (bool) $request->is_main_lang,
            'status' => (bool) $request->status
        ];

        $language = Language::create($data);

        // Create language directory and files
        $this->createLanguageFiles($language->lang_code);

        return redirect()->route('admin.languages.index')->with('success', 'Dil uğurla əlavə edildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $language = Language::findOrFail($id);
        $oldLangCode = $language->lang_code;
        
        $request->validate([
            'title' => 'required|string|max:255',
            'lang_code' => 'required|string|max:10|unique:languages,lang_code,' . $id,
        ]);
        

        $data = [
            'title' => $request->title,
            'lang_code' => $request->lang_code,
            'is_main_lang' => (bool) $request->is_main_lang,
            'status' => (bool) $request->status
        ];

        $language->update($data);

        // If language code changed, rename the directory
        if ($oldLangCode !== $language->lang_code) {
            $this->renameLanguageDirectory($oldLangCode, $language->lang_code);
        }

        return redirect()->route('admin.languages.index')->with('success', 'Dil uğurla yeniləndi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);
        $langCode = $language->lang_code;
        
        $language->delete();

        // Delete language directory and files
        $this->deleteLanguageFiles($langCode);

        return redirect()->route('admin.languages.index')->with('success', 'Dil uğurla silindi!');
    }

    /**
     * Reorder languages
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:languages,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Language::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
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
                'accepted_if' => ':attribute :other :value olduqda qəbul edilməlidir.',
                'active_url' => ':attribute düzgün URL deyil.',
                'after' => ':attribute :date tarixindən sonra olmalıdır.',
                'after_or_equal' => ':attribute :date tarixindən sonra və ya bərabər olmalıdır.',
                'alpha' => ':attribute yalnız hərflərdən ibarət olmalıdır.',
                'alpha_dash' => ':attribute yalnız hərf, rəqəm, tire və alt xəttdən ibarət olmalıdır.',
                'alpha_num' => ':attribute yalnız hərf və rəqəmdən ibarət olmalıdır.',
                'array' => ':attribute massiv olmalıdır.',
                'before' => ':attribute :date tarixindən əvvəl olmalıdır.',
                'before_or_equal' => ':attribute :date tarixindən əvvəl və ya bərabər olmalıdır.',
                'between' => [
                    'array' => ':attribute :min - :max element arasında olmalıdır.',
                    'file' => ':attribute :min - :max kilobayt arasında olmalıdır.',
                    'numeric' => ':attribute :min - :max arasında olmalıdır.',
                    'string' => ':attribute :min - :max simvol arasında olmalıdır.',
                ],
                'boolean' => ':attribute sahəsi doğru və ya yanlış olmalıdır.',
                'confirmed' => ':attribute təsdiqlənməsi uyğun gəlmir.',
                'current_password' => 'Şifrə yanlışdır.',
                'date' => ':attribute düzgün tarix deyil.',
                'date_equals' => ':attribute :date ilə bərabər olmalıdır.',
                'date_format' => ':attribute :format formatı ilə uyğun gəlmir.',
                'declined' => ':attribute rədd edilməlidir.',
                'declined_if' => ':attribute :other :value olduqda rədd edilməlidir.',
                'different' => ':attribute və :other fərqli olmalıdır.',
                'digits' => ':attribute :digits rəqəm olmalıdır.',
                'digits_between' => ':attribute :min - :max rəqəm arasında olmalıdır.',
                'dimensions' => ':attribute şəkil ölçüləri yanlışdır.',
                'distinct' => ':attribute sahəsi təkrarlanan dəyərə malikdir.',
                'doesnt_end_with' => ':attribute aşağıdakılardan biri ilə bitməməlidir: :values.',
                'doesnt_start_with' => ':attribute aşağıdakılardan biri ilə başlamamalıdır: :values.',
                'email' => ':attribute düzgün e-poçt ünvanı olmalıdır.',
                'ends_with' => ':attribute aşağıdakılardan biri ilə bitməlidir: :values.',
                'enum' => 'Seçilmiş :attribute yanlışdır.',
                'exists' => 'Seçilmiş :attribute yanlışdır.',
                'extensions' => ':attribute aşağıdakı genişlənmələrdən birinə malik olmalıdır: :values.',
                'file' => ':attribute fayl olmalıdır.',
                'filled' => ':attribute sahəsi doldurulmalıdır.',
                'gt' => [
                    'array' => ':attribute :value elementdən çox olmalıdır.',
                    'file' => ':attribute :value kilobaytdan çox olmalıdır.',
                    'numeric' => ':attribute :value-dən çox olmalıdır.',
                    'string' => ':attribute :value simvoldan çox olmalıdır.',
                ],
                'gte' => [
                    'array' => ':attribute :value və ya daha çox element olmalıdır.',
                    'file' => ':attribute :value və ya daha çox kilobayt olmalıdır.',
                    'numeric' => ':attribute :value və ya daha çox olmalıdır.',
                    'string' => ':attribute :value və ya daha çox simvol olmalıdır.',
                ],
                'hex_color' => ':attribute düzgün hex rəng kodu olmalıdır.',
                'image' => ':attribute şəkil olmalıdır.',
                'in' => 'Seçilmiş :attribute yanlışdır.',
                'in_array' => ':attribute sahəsi :other içində mövcud deyil.',
                'integer' => ':attribute tam ədəd olmalıdır.',
                'ip' => ':attribute düzgün IP ünvanı olmalıdır.',
                'ipv4' => ':attribute düzgün IPv4 ünvanı olmalıdır.',
                'ipv6' => ':attribute düzgün IPv6 ünvanı olmalıdır.',
                'json' => ':attribute düzgün JSON sətri olmalıdır.',
                'lowercase' => ':attribute kiçik hərflərdən ibarət olmalıdır.',
                'lt' => [
                    'array' => ':attribute :value elementdən az olmalıdır.',
                    'file' => ':attribute :value kilobaytdan az olmalıdır.',
                    'numeric' => ':attribute :value-dən az olmalıdır.',
                    'string' => ':attribute :value simvoldan az olmalıdır.',
                ],
                'lte' => [
                    'array' => ':attribute :value və ya daha az element olmalıdır.',
                    'file' => ':attribute :value və ya daha az kilobayt olmalıdır.',
                    'numeric' => ':attribute :value və ya daha az olmalıdır.',
                    'string' => ':attribute :value və ya daha az simvol olmalıdır.',
                ],
                'mac_address' => ':attribute düzgün MAC ünvanı olmalıdır.',
                'max' => [
                    'array' => ':attribute :max elementdən çox ola bilməz.',
                    'file' => ':attribute :max kilobaytdan çox ola bilməz.',
                    'numeric' => ':attribute :max-dən çox ola bilməz.',
                    'string' => ':attribute :max simvoldan çox ola bilməz.',
                ],
                'max_digits' => ':attribute :max rəqəmdən çox ola bilməz.',
                'mimes' => ':attribute aşağıdakı tipdə olmalıdır: :values.',
                'mimetypes' => ':attribute aşağıdakı MIME tipində olmalıdır: :values.',
                'min' => [
                    'array' => ':attribute ən azı :min element olmalıdır.',
                    'file' => ':attribute ən azı :min kilobayt olmalıdır.',
                    'numeric' => ':attribute ən azı :min olmalıdır.',
                    'string' => ':attribute ən azı :min simvol olmalıdır.',
                ],
                'min_digits' => ':attribute ən azı :min rəqəm olmalıdır.',
                'missing' => ':attribute çatışmamalıdır.',
                'missing_if' => ':attribute :other :value olduqda çatışmamalıdır.',
                'missing_unless' => ':attribute :other :value olmadıqda çatışmamalıdır.',
                'missing_with' => ':attribute :values mövcud olduqda çatışmamalıdır.',
                'missing_with_all' => ':attribute :values mövcud olduqda çatışmamalıdır.',
                'multiple_of' => ':attribute :value-nin qatı olmalıdır.',
                'not_in' => 'Seçilmiş :attribute yanlışdır.',
                'not_regex' => ':attribute formatı yanlışdır.',
                'numeric' => ':attribute rəqəm olmalıdır.',
                'password' => [
                    'letters' => ':attribute ən azı bir hərf tərkibində olmalıdır.',
                    'mixed' => ':attribute ən azı bir böyük və bir kiçik hərf tərkibində olmalıdır.',
                    'numbers' => ':attribute ən azı bir rəqəm tərkibində olmalıdır.',
                    'symbols' => ':attribute ən azı bir simvol tərkibində olmalıdır.',
                    'uncompromised' => 'Verilmiş :attribute məlumat bazasında görünür. Zəhmət olmasa fərqli :attribute seçin.',
                ],
                'present' => ':attribute sahəsi mövcud olmalıdır.',
                'present_if' => ':attribute :other :value olduqda mövcud olmalıdır.',
                'present_unless' => ':attribute :other :value olmadıqda mövcud olmalıdır.',
                'present_with' => ':attribute :values mövcud olduqda mövcud olmalıdır.',
                'present_with_all' => ':attribute :values mövcud olduqda mövcud olmalıdır.',
                'prohibited' => ':attribute sahəsi qadağandır.',
                'prohibited_if' => ':attribute :other :value olduqda qadağandır.',
                'prohibited_unless' => ':attribute :other :values olmadıqda qadağandır.',
                'prohibits' => ':attribute sahəsi :other sahəsinin mövcud olmasını qadağan edir.',
                'regex' => ':attribute formatı yanlışdır.',
                'required' => ':attribute sahəsi tələb olunur.',
                'required_array_keys' => ':attribute sahəsi aşağıdakı girişlər üçün tələb olunur: :values.',
                'required_if' => ':attribute sahəsi :other :value olduqda tələb olunur.',
                'required_if_accepted' => ':attribute sahəsi :other qəbul edildikdə tələb olunur.',
                'required_unless' => ':attribute sahəsi :other :values olmadıqda tələb olunur.',
                'required_with' => ':attribute sahəsi :values mövcud olduqda tələb olunur.',
                'required_with_all' => ':attribute sahəsi :values mövcud olduqda tələb olunur.',
                'required_without' => ':attribute sahəsi :values mövcud olmadıqda tələb olunur.',
                'required_without_all' => ':attribute sahəsi :values-dən heç biri mövcud olmadıqda tələb olunur.',
                'same' => ':attribute və :other uyğun gəlməlidir.',
                'size' => [
                    'array' => ':attribute :size element olmalıdır.',
                    'file' => ':attribute :size kilobayt olmalıdır.',
                    'numeric' => ':attribute :size olmalıdır.',
                    'string' => ':attribute :size simvol olmalıdır.',
                ],
                'starts_with' => ':attribute aşağıdakılardan biri ilə başlamalıdır: :values.',
                'string' => ':attribute sətir olmalıdır.',
                'timezone' => ':attribute düzgün vaxt zonası olmalıdır.',
                'unique' => ':attribute artıq götürülüb.',
                'uploaded' => ':attribute yüklənməsi uğursuz oldu.',
                'uppercase' => ':attribute böyük hərflərdən ibarət olmalıdır.',
                'url' => ':attribute düzgün URL formatında deyil.',
                'ulid' => ':attribute düzgün ULID deyil.',
                'uuid' => ':attribute düzgün UUID deyil.',
                'attributes' => [
                    'address' => 'ünvan',
                    'age' => 'yaş',
                    'amount' => 'məbləğ',
                    'area' => 'sahə',
                    'available' => 'mövcud',
                    'birthday' => 'ad günü',
                    'body' => 'mətn',
                    'city' => 'şəhər',
                    'content' => 'məzmun',
                    'country' => 'ölkə',
                    'current_password' => 'cari şifrə',
                    'date' => 'tarix',
                    'date_of_birth' => 'doğum tarixi',
                    'day' => 'gün',
                    'deleted_at' => 'silinmə tarixi',
                    'description' => 'təsvir',
                    'display_name' => 'göstərilən ad',
                    'district' => 'rayon',
                    'duration' => 'müddət',
                    'email' => 'e-poçt',
                    'excerpt' => 'xülasə',
                    'filter' => 'filtr',
                    'first_name' => 'ad',
                    'gender' => 'cins',
                    'group' => 'qrup',
                    'hour' => 'saat',
                    'image' => 'şəkil',
                    'last_name' => 'soyad',
                    'lesson' => 'dərs',
                    'line_address_1' => 'ünvan sətri 1',
                    'line_address_2' => 'ünvan sətri 2',
                    'message' => 'mesaj',
                    'middle_name' => 'ata adı',
                    'minute' => 'dəqiqə',
                    'mobile' => 'mobil',
                    'month' => 'ay',
                    'name' => 'ad',
                    'national_code' => 'milli kod',
                    'number' => 'nömrə',
                    'password' => 'şifrə',
                    'password_confirmation' => 'şifrə təsdiqi',
                    'phone' => 'telefon',
                    'photo' => 'foto',
                    'postal_code' => 'poçt kodu',
                    'preview' => 'ön baxış',
                    'price' => 'qiymət',
                    'province' => 'vilayət',
                    'recaptcha_response_field' => 'recaptcha cavab sahəsi',
                    'remember' => 'xatırla',
                    'restored_at' => 'bərpa tarixi',
                    'result_text_under_image' => 'şəkil altındakı nəticə mətni',
                    'role' => 'rol',
                    'second' => 'saniyə',
                    'sex' => 'cins',
                    'short_text' => 'qısa mətn',
                    'size' => 'ölçü',
                    'state' => 'ştat',
                    'street' => 'küçə',
                    'student' => 'tələbə',
                    'subject' => 'mövzu',
                    'teacher' => 'müəllim',
                    'terms' => 'şərtlər',
                    'test_description' => 'test təsviri',
                    'test_locale' => 'test dili',
                    'test_name' => 'test adı',
                    'text' => 'mətn',
                    'time' => 'vaxt',
                    'title' => 'başlıq',
                    'updated_at' => 'yenilənmə tarixi',
                    'username' => 'istifadəçi adı',
                    'year' => 'il',
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

    /**
     * Delete language directory and files
     */
    private function deleteLanguageFiles($langCode)
    {
        $langPath = resource_path('lang/' . $langCode);
        $jsonPath = resource_path('lang/' . $langCode . '.json');
        
        // Delete language directory
        if (File::exists($langPath)) {
            File::deleteDirectory($langPath);
        }
        
        // Delete JSON file
        if (File::exists($jsonPath)) {
            File::delete($jsonPath);
        }
    }

    /**
     * Rename language directory
     */
    private function renameLanguageDirectory($oldLangCode, $newLangCode)
    {
        $oldLangPath = resource_path('lang/' . $oldLangCode);
        $newLangPath = resource_path('lang/' . $newLangCode);
        $oldJsonPath = resource_path('lang/' . $oldLangCode . '.json');
        $newJsonPath = resource_path('lang/' . $newLangCode . '.json');
        
        // Rename directory
        if (File::exists($oldLangPath)) {
            File::moveDirectory($oldLangPath, $newLangPath);
        }
        
        // Rename JSON file
        if (File::exists($oldJsonPath)) {
            File::move($oldJsonPath, $newJsonPath);
        }
    }
}
