<?php

namespace App\Models;

use App\Support\LegacyAsset;
use Database\Factories\PageContentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['key', 'title', 'subtitle', 'hero_image', 'body_html', 'data', 'meta_description'])]
class PageContent extends Model
{
    /** @use HasFactory<PageContentFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public static function fallback(string $key): static
    {
        $description = 'Pay your ACRA subscription securely through the official Akright City payment portal.';

        return static::firstOrNew(['key' => $key], [
            'title' => Str::headline($key),
            'subtitle' => $key === 'payments' ? $description : '',
            'meta_description' => $key === 'payments' ? $description : null,
            'data' => static::fallbackData($key),
        ]);
    }

    private static function fallbackData(string $key): array
    {
        return match ($key) {
            'home' => [
                'slides' => [[
                    'title' => 'Welcome to Akright City',
                    'subtitle' => 'Empowering our community, one story at a time.',
                    'cta' => 'Join the Association',
                    'image' => LegacyAsset::url('images/slide1.jpeg'),
                ]],
                'mission' => '',
                'vision' => '',
                'values' => [],
                'quick_links' => [],
                'gallery' => ['title' => 'Gallery', 'subtitle' => 'Community Moments', 'image' => null],
            ],
            'president' => [
                'intro' => '',
                'body' => '',
                'signature_name' => 'Simon Kaggwa',
                'signature_role' => 'ACRA President - 2026',
            ],
            default => [],
        };
    }
}
