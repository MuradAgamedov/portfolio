<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios
     */
    public function index(Request $request)
    {
        $query = Portfolio::with('category')->orderBy('order');

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $portfolios = $query->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    /**
     * Show the form for creating a new portfolio
     */
    public function create()
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        return view('admin.portfolios.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created portfolio
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'project_link' => 'nullable|url|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->resizeAndConvertToWebp($request->file('image'));
        }

        Portfolio::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'project_link' => $request->project_link,
            'category_id' => $request->category_id,
            'status' => $request->has('status'),
            'order' => Portfolio::max('order') + 1
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla əlavə edildi!');
    }

    /**
     * Show the form for editing a portfolio
     */
    public function edit(Portfolio $portfolio)
    {
        $languages = Language::where('status', true)->orderBy('order')->get();
        $categories = PortfolioCategory::where('status', true)->orderBy('order')->get();
        return view('admin.portfolios.edit', compact('portfolio', 'languages', 'categories'));
    }

    /**
     * Update the specified portfolio
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'project_link' => 'nullable|url|max:255',
            'category_id' => 'nullable|exists:portfolio_categories,id',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'project_link' => $request->project_link,
            'category_id' => $request->category_id,
            'status' => $request->has('status')
        ];

        if ($request->hasFile('image')) {
            // Köhnə şəkli sil
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            $updateData['image'] = $this->resizeAndConvertToWebp($request->file('image'));
        }

        $portfolio->update($updateData);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla yeniləndi!');
    }

    /**
     * Remove the specified portfolio
     */
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla silindi!');
    }

    /**
     * Reorder portfolios
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:portfolios,id',
            'orders.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->orders as $item) {
            Portfolio::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Sıralama yeniləndi!']);
    }

    /**
     * Resize and convert image to WebP format (350px width)
     */
    private function resizeAndConvertToWebp($image)
    {
        $srcPath = $image->getRealPath();
        $imageInfo = getimagesize($srcPath);
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        // Yeni ölçülər
        $newWidth = 350;
        $newHeight = intval(($height / $width) * 350);

        // Şəkli oxu
        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $src = imagecreatefromjpeg($srcPath);
                break;
            case 'image/png':
                $src = imagecreatefrompng($srcPath);
                break;
            case 'image/gif':
                $src = imagecreatefromgif($srcPath);
                break;
            case 'image/webp':
                $src = imagecreatefromwebp($srcPath);
                break;
            default:
                throw new \Exception('Dəstəklənməyən şəkil formatı.');
        }

        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $filename = uniqid('portfolio_') . '.webp';
        $path = 'portfolios/images/' . $filename;
        $tempPath = sys_get_temp_dir() . '/' . $filename;

        imagewebp($dst, $tempPath, 90);
        Storage::disk('public')->put($path, file_get_contents($tempPath));

        imagedestroy($src);
        imagedestroy($dst);
        unlink($tempPath);

        return $path;
    }
}
