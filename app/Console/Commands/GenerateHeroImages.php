<?php

namespace App\Console\Commands;

use App\Support\HeroImage;
use App\Support\LegacyAsset;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('app:generate-hero-images {--force : Regenerate images even when they already exist}')]
#[Description('Generate optimized hero images from high-resolution legacy gallery photos')]
class GenerateHeroImages extends Command
{
    private const IMAGE_WIDTH = 2400;

    private const IMAGE_HEIGHT = 1350;

    private const THUMB_WIDTH = 480;

    private const THUMB_HEIGHT = 300;

    public function handle(): int
    {
        ini_set('memory_limit', '512M');
        $publicHeroPath = public_path('hero');

        if (! is_dir($publicHeroPath)) {
            mkdir($publicHeroPath, 0755, true);
        }

        Storage::disk('public')->makeDirectory('hero');
        $generated = 0;
        $skipped = 0;
        $failed = 0;

        foreach (HeroImage::definitions() as $key => $definition) {
            $source = 'legacy/'.$definition['source'];
            $image = 'hero/'.$definition['image'];
            $thumbnail = 'hero/'.$definition['thumbnail'];
            $publicImagePath = $publicHeroPath.DIRECTORY_SEPARATOR.$definition['image'];
            $publicThumbnailPath = $publicHeroPath.DIRECTORY_SEPARATOR.$definition['thumbnail'];

            $sourcePath = Storage::disk('public')->exists($source) ? Storage::disk('public')->path($source) : null;

            if ($sourcePath === null) {
                $local = LegacyAsset::localPath($definition['source']);
                if ($local !== null && Storage::disk('public')->exists('legacy/'.$local)) {
                    $sourcePath = Storage::disk('public')->path('legacy/'.$local);
                }
            }

            if ($sourcePath === null) {
                $failed++;
                $this->warn("Missing: {$source}");

                continue;
            }

            if (! $this->option('force') && is_file($publicImagePath) && is_file($publicThumbnailPath)) {
                $skipped++;
                $this->line("Skipped: {$key}");

                continue;
            }

            try {
                $this->generate(
                    $sourcePath,
                    $publicImagePath,
                    self::IMAGE_WIDTH,
                    self::IMAGE_HEIGHT,
                    $definition['position'],
                );

                $this->generate(
                    $sourcePath,
                    $publicThumbnailPath,
                    self::THUMB_WIDTH,
                    self::THUMB_HEIGHT,
                    $definition['position'],
                );

                @copy($publicImagePath, Storage::disk('public')->path($image));
                @copy($publicThumbnailPath, Storage::disk('public')->path($thumbnail));

                $generated++;
                $this->info("Generated: {$key}");
            } catch (\Throwable $exception) {
                $failed++;
                $this->warn("Failed: {$key} ({$exception->getMessage()})");
            }
        }

        LegacyAsset::clearCache();
        $this->info("Generated {$generated} hero image(s); {$skipped} skipped; {$failed} failed.");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function generate(string $sourcePath, string $destinationPath, int $width, int $height, string $position): void
    {
        $size = getimagesize($sourcePath);

        if ($size === false) {
            throw new \RuntimeException('Unable to read source image.');
        }

        $sourceWidth = (int) $size[0];
        $sourceHeight = (int) $size[1];
        $source = $this->createImage($sourcePath, (string) ($size['mime'] ?? ''));
        $targetRatio = $width / $height;
        $sourceRatio = $sourceWidth / $sourceHeight;

        if ($sourceRatio > $targetRatio) {
            $cropWidth = (int) round($sourceHeight * $targetRatio);
            $cropHeight = $sourceHeight;
            $cropX = $this->cropOffset($sourceWidth, $cropWidth, $position);
            $cropY = 0;
        } else {
            $cropWidth = $sourceWidth;
            $cropHeight = (int) round($sourceWidth / $targetRatio);
            $cropX = 0;
            $cropY = $this->cropOffset($sourceHeight, $cropHeight, $position);
        }

        $target = imagecreatetruecolor($width, $height);

        if (! $target instanceof \GdImage) {
            imagedestroy($source);
            throw new \RuntimeException('Unable to create output image.');
        }

        imagecopyresampled($target, $source, 0, 0, $cropX, $cropY, $width, $height, $cropWidth, $cropHeight);

        if (! imagewebp($target, $destinationPath, 84)) {
            imagedestroy($source);
            imagedestroy($target);
            throw new \RuntimeException('Unable to write output image.');
        }

        imagedestroy($source);
        imagedestroy($target);
    }

    private function createImage(string $path, string $mime): \GdImage
    {
        $image = match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/webp' => imagecreatefromwebp($path),
            default => throw new \RuntimeException("Unsupported image type: {$mime}"),
        };

        if (! $image instanceof \GdImage) {
            throw new \RuntimeException('Unable to decode source image.');
        }

        return $image;
    }

    private function cropOffset(int $size, int $crop, string $position): int
    {
        return match ($position) {
            'top', 'left' => 0,
            'bottom', 'right' => $size - $crop,
            default => intdiv($size - $crop, 2),
        };
    }
}
