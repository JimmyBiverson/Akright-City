<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class HeroImage
{
    /** @var array<string, array{source: string, image: string, thumbnail: string, position: string}> */
    private const HEROES = [
        'images/akrightrun2026.jpeg' => [
            'source' => 'images/gallery/2026/Akright Run/WhatsApp Image 2026-05-12 at 21.10.11.jpeg',
            'image' => 'akrightrun2026.webp',
            'thumbnail' => 'akrightrun2026-thumb.webp',
            'position' => 'center',
        ],
        'images/akrightrun2026b.jpeg' => [
            'source' => 'images/gallery/2026/Akright Run/WhatsApp Image 2026-05-12 at 21.10.14.jpeg',
            'image' => 'akrightrun2026b.webp',
            'thumbnail' => 'akrightrun2026b-thumb.webp',
            'position' => 'center',
        ],
        'images/akrightrun2026c.jpeg' => [
            'source' => 'images/gallery/2026/Akright Run/WhatsApp Image 2026-05-12 at 21.10.21.jpeg',
            'image' => 'akrightrun2026c.webp',
            'thumbnail' => 'akrightrun2026c-thumb.webp',
            'position' => 'center',
        ],
        'images/slide1.jpeg' => [
            'source' => 'images/gallery/2026/Womens Day/N49A2803.JPG',
            'image' => 'slide1.webp',
            'thumbnail' => 'slide1-thumb.webp',
            'position' => 'center',
        ],
        'images/slide2.jpeg' => [
            'source' => 'images/gallery/2026/Mens Day/DEN_0898.jpg',
            'image' => 'slide2.webp',
            'thumbnail' => 'slide2-thumb.webp',
            'position' => 'center',
        ],
        'images/slide3.jpeg' => [
            'source' => 'images/gallery/2026/Youth Day/WhatsApp Image 2026-02-11 at 1.24.34 PM.jpeg',
            'image' => 'slide3.webp',
            'thumbnail' => 'slide3-thumb.webp',
            'position' => 'top',
        ],
    ];

    /**
     * @return array<string, array{source: string, image: string, thumbnail: string, position: string}>
     */
    public static function definitions(): array
    {
        return self::HEROES;
    }

    public static function sourcePathFor(string $path): ?string
    {
        return self::HEROES[LegacyAsset::normalizePath($path)]['source'] ?? null;
    }

    public static function imagePathFor(string $path): ?string
    {
        return self::HEROES[LegacyAsset::normalizePath($path)]['image'] ?? null;
    }

    public static function thumbnailPathFor(string $path): ?string
    {
        return self::HEROES[LegacyAsset::normalizePath($path)]['thumbnail'] ?? null;
    }

    public static function focusPositionFor(string $path): string
    {
        return self::HEROES[LegacyAsset::normalizePath($path)]['position'] ?? 'center';
    }

    public static function urlFor(string $path): string
    {
        $image = self::imagePathFor($path);

        if ($image !== null && Storage::disk('public')->exists('hero/'.$image)) {
            return Storage::url('hero/'.$image);
        }

        return LegacyAsset::url($path);
    }

    public static function thumbnailUrlFor(string $path): string
    {
        $thumbnail = self::thumbnailPathFor($path);

        if ($thumbnail !== null && Storage::disk('public')->exists('hero/'.$thumbnail)) {
            return Storage::url('hero/'.$thumbnail);
        }

        return self::urlFor($path);
    }
}
