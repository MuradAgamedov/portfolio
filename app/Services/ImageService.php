<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Upload image and return filename
     */
    public function uploadImage(UploadedFile $image, string $path = 'images'): string
    {
        // Store using storage disk and return path
        $storedPath = $image->store($path, 'public');
        
        return $storedPath;
    }

    /**
     * Delete image from storage
     */
    public function deleteImage(?string $imagePath): bool
    {
        if (!$imagePath) {
            return false;
        }

        return Storage::disk('public')->delete($imagePath);
    }

    /**
     * Update image (delete old and upload new)
     */
    public function updateImage(UploadedFile $newImage, ?string $oldImagePath = null, string $path = 'images'): string
    {
        // Delete old image if exists
        if ($oldImagePath) {
            $this->deleteImage($oldImagePath);
        }

        // Upload new image
        return $this->uploadImage($newImage, $path);
    }
}
