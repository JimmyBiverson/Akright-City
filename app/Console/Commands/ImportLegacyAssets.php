<?php

namespace App\Console\Commands;

use App\Models\GalleryImage;
use App\Models\NewsPost;
use App\Models\PageContent;
use App\Models\Partner;
use App\Models\Report;
use App\Models\TeamMember;
use App\Models\Village;
use App\Support\LegacyAsset;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

#[Signature('app:import-legacy-assets {--dry-run : List assets without downloading them}')]
#[Description('Download seeded legacy assets into local public storage')]
class ImportLegacyAssets extends Command
{
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $paths = $this->collectPaths();
        $downloaded = 0;
        $failed = 0;

        foreach ($paths as $path) {
            $normalized = LegacyAsset::normalizePath($path);

            if ($normalized === '' || str_contains($normalized, '..')) {
                continue;
            }

            if ($dryRun) {
                $this->line($normalized);

                continue;
            }

            if (Storage::disk('public')->exists('legacy/'.$normalized)) {
                $this->line("Skipped: {$normalized}");

                continue;
            }

            $request = Http::timeout(30);
            $caBundle = env('LEGACY_ASSET_CA_BUNDLE');

            if (filled($caBundle)) {
                $request = $request->withOptions(['verify' => $caBundle]);
            }

            $response = $request->get(LegacyAsset::remoteUrl($normalized));

            if (! $response->successful()) {
                $failed++;
                $this->warn("Failed: {$normalized}");

                continue;
            }

            $storagePath = 'legacy/'.$normalized;
            Storage::disk('public')->put($storagePath, $response->body());
            $downloaded++;
        }

        LegacyAsset::clearCache();
        $this->info("Imported {$downloaded} asset(s); {$failed} failed.");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * @return array<int, string>
     */
    private function collectPaths(): array
    {
        $paths = [];

        foreach (PageContent::all() as $page) {
            $paths[] = $page->hero_image;
            $this->collectValue($page->data, $paths);
            $this->collectHtml($page->body_html, $paths);
        }

        foreach (Village::all() as $village) {
            $paths[] = $village->card_image;
            $paths[] = $village->map_image;
            $paths[] = $village->chairperson_message;
            $paths[] = $village->body_html;
            foreach ($village->gallery_images ?? [] as $image) {
                $paths[] = $image;
            }
        }

        foreach (TeamMember::pluck('photo') as $path) {
            $paths[] = $path;
        }

        foreach (NewsPost::all() as $post) {
            $paths[] = $post->image;
            $paths[] = $post->link;
            $this->collectHtml($post->body_html, $paths);
        }

        foreach (Report::pluck('path') as $path) {
            $paths[] = $path;
        }

        foreach (GalleryImage::pluck('path') as $path) {
            $paths[] = $path;
        }

        foreach (Partner::pluck('logo') as $path) {
            $paths[] = $path;
        }

        return array_values(array_unique(array_filter(
            $paths,
            fn (mixed $path): bool => is_string($path) && filled($path) && LegacyAsset::isLegacyPath($path),
        )));
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function collectValue(mixed $value, array &$paths): void
    {
        if (is_string($value)) {
            $paths[] = $value;

            return;
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                $this->collectValue($item, $paths);
            }
        }
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function collectHtml(?string $html, array &$paths): void
    {
        if ($html === null || $html === '') {
            return;
        }

        preg_match_all('~[^"\'\s)>]*(?:images|reports)/[^"\'\s)>]+~i', $html, $matches);

        foreach ($matches[0] as $path) {
            $paths[] = $path;
        }
    }
}
