<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Synchronize storage/app/public directory to public/storage.
 * Useful for production/shared hosting environments where artisan storage:link symlink fails or is forbidden.
 */
Artisan::command('storage:sync', function () {
    $source = storage_path('app/public');
    if (!is_dir($source)) {
        $this->error("Source directory [$source] does not exist.");
        return 1;
    }

    $destinations = [
        public_path('storage') => public_path(),
        base_path('public/storage') => base_path('public'),
        base_path('public_html/storage') => base_path('public_html'),
        dirname(base_path()) . '/public_html/storage' => dirname(base_path()) . '/public_html',
    ];

    $count = 0;
    $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($destinations as $dest => $webRoot) {
        if (!is_dir($webRoot)) {
            continue;
        }

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
                        $count++;
                    }
                }
            }
        }
    }

    $this->info("Successfully synchronized {$count} file(s) from storage to public.");
    return 0;
})->purpose('Synchronize storage/app/public files directly to public/storage for environments without working symlinks');

