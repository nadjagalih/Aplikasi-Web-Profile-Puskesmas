<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;

class CleanUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:clean-unused {--dry-run : Hanya tampilkan file yang akan dihapus tanpa menghapusnya}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus gambar yang tidak digunakan di folder content-images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $this->info('Memulai pembersihan gambar yang tidak digunakan...');
        $this->newLine();

        // Get all images in content-images folder
        $contentImagesPath = 'content-images';
        
        if (!Storage::disk('public')->exists($contentImagesPath)) {
            $this->warn('Folder content-images tidak ditemukan!');
            return 0;
        }

        $allImages = Storage::disk('public')->files($contentImagesPath);
        
        if (empty($allImages)) {
            $this->info('Tidak ada gambar di folder content-images.');
            return 0;
        }

        $this->info('Total gambar ditemukan: ' . count($allImages));
        $this->newLine();

        // Get all pages content
        $pages = Page::all();
        $usedImages = [];

        // Extract image URLs from page content
        foreach ($pages as $page) {
            if ($page->content) {
                // Find all image URLs in content
                preg_match_all('/storage\/content-images\/([^\s"\'<>]+)/', $page->content, $matches);
                if (!empty($matches[1])) {
                    foreach ($matches[1] as $imageName) {
                        $usedImages[] = $contentImagesPath . '/' . $imageName;
                    }
                }
            }
        }

        $usedImages = array_unique($usedImages);
        $this->info('Gambar yang digunakan: ' . count($usedImages));
        $this->newLine();

        // Find unused images
        $unusedImages = array_diff($allImages, $usedImages);
        
        if (empty($unusedImages)) {
            $this->info('✓ Semua gambar sedang digunakan. Tidak ada yang perlu dihapus.');
            return 0;
        }

        $this->warn('Ditemukan ' . count($unusedImages) . ' gambar yang tidak digunakan:');
        $this->newLine();

        $totalSize = 0;
        foreach ($unusedImages as $image) {
            $size = Storage::disk('public')->size($image);
            $totalSize += $size;
            $this->line('  - ' . basename($image) . ' (' . $this->formatBytes($size) . ')');
        }

        $this->newLine();
        $this->info('Total ukuran: ' . $this->formatBytes($totalSize));
        $this->newLine();

        if ($dryRun) {
            $this->warn('Mode DRY RUN: File tidak akan dihapus.');
            $this->info('Jalankan tanpa --dry-run untuk menghapus file.');
            return 0;
        }

        // Confirm deletion
        if (!$this->confirm('Apakah Anda yakin ingin menghapus ' . count($unusedImages) . ' gambar ini?', false)) {
            $this->info('Pembersihan dibatalkan.');
            return 0;
        }

        // Delete unused images
        $deletedCount = 0;
        foreach ($unusedImages as $image) {
            try {
                Storage::disk('public')->delete($image);
                $deletedCount++;
            } catch (\Exception $e) {
                $this->error('Gagal menghapus: ' . basename($image) . ' - ' . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info('✓ Berhasil menghapus ' . $deletedCount . ' gambar.');
        $this->info('✓ Ruang yang dibebaskan: ' . $this->formatBytes($totalSize));

        return 0;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
