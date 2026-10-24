<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesImageUploads
{
    /**
     * Store an uploaded file safely for both local and live/shared-hosting environments.
     * Ensures the file is saved in storage/app/public AND public/storage (and public_html/storage if present).
     */
    public function uploadImage(UploadedFile $file, string $folder = 'uploads'): string
    {
        $folder = trim($folder, '/\\');
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'png');
        $filename = time() . '_' . Str::random(20) . '.' . $extension;
        $relativePath = $folder . '/' . $filename;

        // 1. Ensure storage/app/public/{folder} directory exists
        $storageDir = storage_path('app/public/' . $folder);
        if (!is_dir($storageDir)) {
            @mkdir($storageDir, 0775, true);
        }
        $storagePath = $storageDir . '/' . $filename;

        // Try standard Laravel Storage disk first
        try {
            Storage::disk('public')->putFileAs($folder, $file, $filename);
        } catch (\Throwable $e) {
            // Fallback will copy manually below
        }

        // If not created by Storage disk, manually copy from temp file
        if (!file_exists($storagePath) && $file->getRealPath()) {
            @copy($file->getRealPath(), $storagePath);
        }

        // 2. Also ensure public storage directories exist and copy file there
        $targetPublicDirs = $this->resolvePublicStorageDirectories($folder);
        foreach ($targetPublicDirs as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0775, true);
            }
            $targetFile = $dir . DIRECTORY_SEPARATOR . $filename;
            if (!file_exists($targetFile)) {
                if (file_exists($storagePath)) {
                    @copy($storagePath, $targetFile);
                } elseif ($file->getRealPath()) {
                    @copy($file->getRealPath(), $targetFile);
                }
            }
        }

        return $relativePath;
    }

    /**
     * Safely delete an image file across storage disk and all public storage mirrors.
     */
    public function deleteImage(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $cleanPath = ltrim(str_replace(['\\', 'storage/'], ['/', ''], $relativePath), '/');

        // 1. Delete from Laravel Storage disk
        try {
            if (Storage::disk('public')->exists($cleanPath)) {
                Storage::disk('public')->delete($cleanPath);
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // 2. Delete from storage_path
        $storageFile = storage_path('app/public/' . $cleanPath);
        if (file_exists($storageFile)) {
            @unlink($storageFile);
        }

        // 3. Delete from public storage mirrors
        $folder = dirname($cleanPath);
        $filename = basename($cleanPath);
        $targetDirs = $this->resolvePublicStorageDirectories($folder === '.' ? '' : $folder);
        foreach ($targetDirs as $dir) {
            $targetFile = $dir . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($targetFile)) {
                @unlink($targetFile);
            }
        }
    }

    /**
     * Synchronize all files from storage/app/public into public storage directories.
     */
    public function syncStorageFiles(): int
    {
        $source = storage_path('app/public');
        if (!is_dir($source)) {
            return 0;
        }

        $destinations = $this->resolvePublicStorageDirectories('');
        $copiedCount = 0;

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($destinations as $dest) {
            if (!is_dir($dest)) {
                @mkdir($dest, 0775, true);
            }

            foreach ($iterator as $item) {
                $subPath = substr($item->getPathname(), strlen($source) + 1);
                $target = $dest . DIRECTORY_SEPARATOR . $subPath;

                if ($item->isDir()) {
                    if (!is_dir($target)) {
                        @mkdir($target, 0775, true);
                    }
                } else {
                    $targetDir = dirname($target);
                    if (!is_dir($targetDir)) {
                        @mkdir($targetDir, 0775, true);
                    }
                    if (!file_exists($target) || filemtime($item->getPathname()) > filemtime($target)) {
                        if (@copy($item->getPathname(), $target)) {
                            $copiedCount++;
                        }
                    }
                }
            }
        }

        return $copiedCount;
    }

    /**
     * Resolve all candidate public storage directories across typical hosting environments.
     */
    protected function resolvePublicStorageDirectories(string $folder = ''): array
    {
        $sub = $folder !== '' ? DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $folder) : '';

        $candidates = [
            public_path('storage' . $sub) => public_path(),
            base_path('public' . DIRECTORY_SEPARATOR . 'storage' . $sub) => base_path('public'),
            base_path('public_html' . DIRECTORY_SEPARATOR . 'storage' . $sub) => base_path('public_html'),
            dirname(base_path()) . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'storage' . $sub => dirname(base_path()) . DIRECTORY_SEPARATOR . 'public_html',
        ];

        $valid = [];
        foreach ($candidates as $targetPath => $webRoot) {
            if (is_dir($webRoot)) {
                $valid[] = rtrim($targetPath, DIRECTORY_SEPARATOR);
            }
        }

        return array_unique($valid);
    }
}
