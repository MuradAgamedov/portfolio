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
            $image = $request->file('image');
            $filename = uniqid('portfolio_') . '.webp';
            $path = 'portfolios/images/' . $filename;

            // Məzmunu oxu
            $srcPath = $image->getRealPath();
            $imageInfo = getimagesize($srcPath);
            $width = $imageInfo[0];
            $height = $imageInfo[1];

            // Yeni ölçüləri hesabla (en 350px)
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
                    return back()->with('error', 'Dəstəklənməyən şəkil formatı.');
            }

            // Yeni ölçüdə boş şəkil yaradılır
            $dst = imagecreatetruecolor($newWidth, $newHeight);

            // Şəffaf fonları dəstəklə (PNG və WEBP üçün)
            imagealphablending($dst, false);
            imagesavealpha($dst, true);

            // Şəkli kopyala və ölçüsünü dəyiş
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Müvəqqəti fayl
            $tempPath = sys_get_temp_dir() . '/' . $filename;
            imagewebp($dst, $tempPath, 90);

            // Yaddaşa yaz
            Storage::disk('public')->put($path, file_get_contents($tempPath));

            // Resursları təmizlə
            imagedestroy($src);
            imagedestroy($dst);
            unlink($tempPath);

            $imagePath = $path;
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
     * Update existing portfolio
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
            'status' => $request->has('status'),
        ];

        if ($request->hasFile('image')) {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            $image = $request->file('image');
            $filename = uniqid('portfolio_') . '.webp';
            $path = 'portfolios/images/' . $filename;

            $srcPath = $image->getRealPath();
            $imageInfo = getimagesize($srcPath);
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $newWidth = 350;
            $newHeight = intval(($height / $width) * 350);

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
                    return back()->with('error', 'Dəstəklənməyən şəkil formatı.');
            }

            $dst = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $tempPath = sys_get_temp_dir() . '/' . $filename;
            imagewebp($dst, $tempPath, 90);
            Storage::disk('public')->put($path, file_get_contents($tempPath));

            imagedestroy($src);
            imagedestroy($dst);
            unlink($tempPath);

            $updateData['image'] = $path;
        }

        $portfolio->update($updateData);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio uğurla yeniləndi!');
    }
}
