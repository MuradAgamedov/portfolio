<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Portfolio;

class OptimizePortfolioImages extends Command
{
    protected $signature = 'images:optimize-portfolio {--webp : Convert images to WebP format}';
    protected $description = 'Optimize portfolio images - resize to 350x250 and compress using native PHP. Use --webp to convert to WebP format';

    public function handle()
    {
        $convertToWebp = $this->option('webp');
        
        $this->info('Starting portfolio images optimization...');
        if ($convertToWebp) {
            $this->info('WebP conversion enabled');
        }
        
        $portfolioPath = 'portfolios/images';
        $files = Storage::disk('public')->files($portfolioPath);
        
        $totalFiles = count($files);
        $this->info("Found {$totalFiles} images to optimize");
        
        $progressBar = $this->output->createProgressBar($totalFiles);
        $progressBar->start();
        
        $optimizedCount = 0;
        $webpCount = 0;
        $errorCount = 0;
        
        foreach ($files as $file) {
            try {
                $result = $this->optimizeImage($file, $convertToWebp);
                $optimizedCount++;
                if ($result['webp_created']) {
                    $webpCount++;
                }
            } catch (\Exception $e) {
                $this->error("Error optimizing {$file}: " . $e->getMessage());
                $errorCount++;
            }
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->newLine();
        
        $this->info("Optimization completed!");
        $this->info("Successfully optimized: {$optimizedCount} images");
        if ($convertToWebp) {
            $this->info("WebP versions created: {$webpCount} images");
        }
        if ($errorCount > 0) {
            $this->warn("Errors encountered: {$errorCount} images");
        }
        
        return Command::SUCCESS;
    }
    
    private function optimizeImage($filePath, $convertToWebp = false)
    {
        // Get file info
        $fileInfo = pathinfo($filePath);
        $extension = strtolower($fileInfo['extension']);
        $filename = $fileInfo['filename'];
        $directory = $fileInfo['dirname'];
        
        // Skip if not an image
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return ['webp_created' => false];
        }
        
        // Get full file path
        $fullPath = Storage::disk('public')->path($filePath);
        
        // Get original image info
        $imageInfo = getimagesize($fullPath);
        if (!$imageInfo) {
            $this->warn("Could not get image info for: {$filePath}");
            return ['webp_created' => false];
        }
        
        $originalWidth = $imageInfo[0];
        $originalHeight = $imageInfo[1];
        $mimeType = $imageInfo['mime'];
        
        // Create image resource based on type
        $sourceImage = null;
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($fullPath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($fullPath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($fullPath);
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($fullPath);
                break;
            default:
                $this->warn("Unsupported image type: {$mimeType}");
                return ['webp_created' => false];
        }
        
        if (!$sourceImage) {
            $this->warn("Could not create image resource for: {$filePath}");
            return ['webp_created' => false];
        }
        
        // Calculate new dimensions maintaining aspect ratio
        $targetWidth = 350;
        $targetHeight = 250;
        
        $aspectRatio = $originalWidth / $originalHeight;
        $targetAspectRatio = $targetWidth / $targetHeight;
        
        if ($aspectRatio > $targetAspectRatio) {
            // Image is wider, fit to width
            $newWidth = $targetWidth;
            $newHeight = (int) ($targetWidth / $aspectRatio);
        } else {
            // Image is taller, fit to height
            $newHeight = $targetHeight;
            $newWidth = (int) ($targetHeight * $aspectRatio);
        }
        
        // Create new image with target dimensions
        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);
        
        // Fill with white background
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);
        
        // Calculate position to center the image
        $x = (int) (($targetWidth - $newWidth) / 2);
        $y = (int) (($targetHeight - $newHeight) / 2);
        
        // Resize and copy image
        imagecopyresampled(
            $newImage, $sourceImage,
            $x, $y, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );
        
        // Get original file size
        $originalSize = filesize($fullPath);
        
        // Save optimized image
        $tempPath = tempnam(sys_get_temp_dir(), 'optimized_');
        $saved = false;
        
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $saved = imagejpeg($newImage, $tempPath, 85); // 85% quality
                break;
            case 'png':
                // PNG compression level 8 (0-9, where 9 is highest compression)
                $saved = imagepng($newImage, $tempPath, 8);
                break;
            case 'gif':
                $saved = imagegif($newImage, $tempPath);
                break;
            case 'webp':
                $saved = imagewebp($newImage, $tempPath, 85); // 85% quality
                break;
        }
        
        $webpCreated = false;
        
        if ($saved) {
            // Replace original file
            $optimizedContent = file_get_contents($tempPath);
            Storage::disk('public')->put($filePath, $optimizedContent);
            
            // Get optimized file size
            $optimizedSize = strlen($optimizedContent);
            $savings = $originalSize - $optimizedSize;
            $savingsPercent = round(($savings / $originalSize) * 100, 2);
            
            $this->line("Optimized: {$filePath} ({$originalWidth}x{$originalHeight} → {$newWidth}x{$newHeight})");
            $this->line("Size: " . $this->formatBytes($originalSize) . " → " . $this->formatBytes($optimizedSize) . " (Saved: {$savingsPercent}%)");
            
            // Create WebP version if requested
            if ($convertToWebp && function_exists('imagewebp')) {
                $webpPath = $directory . '/' . $filename . '.webp';
                $webpTempPath = tempnam(sys_get_temp_dir(), 'webp_');
                
                // Check if WebP version already exists
                if (Storage::disk('public')->exists($webpPath)) {
                    $this->line("WebP already exists: {$webpPath} - checking database");
                    $webpCreated = true;
                } else {
                    if (imagewebp($newImage, $webpTempPath, 85)) {
                        $webpContent = file_get_contents($webpTempPath);
                        Storage::disk('public')->put($webpPath, $webpContent);
                        
                        $webpSize = strlen($webpContent);
                        $webpSavings = $optimizedSize - $webpSize;
                        $webpSavingsPercent = round(($webpSavings / $optimizedSize) * 100, 2);
                        
                        $this->line("WebP created: {$webpPath} - " . $this->formatBytes($webpSize) . " (Additional savings: {$webpSavingsPercent}%)");
                        $webpCreated = true;
                        
                        unlink($webpTempPath);
                    }
                }
                
                // Always update database with WebP path (even if WebP already exists)
                $this->updatePortfolioImageInDatabase($filePath, $webpPath);
            }
            
            // Clean up temp file
            unlink($tempPath);
        }
        
        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        return ['webp_created' => $webpCreated];
    }
    
    private function updatePortfolioImageInDatabase($originalPath, $webpPath)
    {
        try {
            // Find portfolio with this image (try both original and WebP paths)
            $portfolio = Portfolio::where('image', $originalPath)
                ->orWhere('image', $webpPath)
                ->first();
            
            if ($portfolio) {
                // Check if already using WebP
                if ($portfolio->image === $webpPath) {
                    $this->line("Portfolio ID {$portfolio->id} already uses WebP image: {$webpPath}");
                } else {
                    // Update to WebP version
                    $portfolio->update(['image' => $webpPath]);
                    $this->line("Database updated: Portfolio ID {$portfolio->id} now uses WebP image");
                    
                    // Delete original image if WebP exists and they're different
                    if ($originalPath !== $webpPath && Storage::disk('public')->exists($webpPath)) {
                        Storage::disk('public')->delete($originalPath);
                        $this->line("Original image deleted: {$originalPath}");
                    }
                }
            } else {
                $this->warn("No portfolio found with image: {$originalPath}");
            }
        } catch (\Exception $e) {
            $this->error("Error updating database: " . $e->getMessage());
        }
    }
    
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
