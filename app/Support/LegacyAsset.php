<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LegacyAsset
{
    /** @var array<string, string> */
    private static array $resolved = [];

    public static function url(string $path): string
    {
        if (Str::startsWith($path, ['https://', 'http://'])) {
            $normalizedRemote = self::normalizePath($path);

            if ($normalizedRemote !== '' && ! str_contains($normalizedRemote, '..')) {
                $local = self::localPath($normalizedRemote);

                if ($local !== null) {
                    return self::$resolved[$path] = Storage::url('legacy/'.$local);
                }
            }

            return $path;
        }

        if (isset(self::$resolved[$path])) {
            return self::$resolved[$path];
        }

        $normalized = self::normalizePath($path);

        if ($normalized !== '' && ! str_contains($normalized, '..')) {
            $local = self::localPath($normalized);

            if ($local !== null) {
                return self::$resolved[$path] = Storage::url('legacy/'.$local);
            }
        }

        return self::$resolved[$path] = self::remoteUrl($normalized);
    }

    public static function localPath(string $path): ?string
    {
        $normalized = self::normalizePath($path);

        if ($normalized === '' || str_contains($normalized, '..')) {
            return null;
        }

        foreach (self::localCandidates($normalized) as $candidate) {
            if (Storage::disk('public')->exists('legacy/'.$candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    /**
     * @return array<int, string>
     */
    private static function localCandidates(string $path): array
    {
        $candidates = [$path];
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $base = $extension !== '' ? substr($path, 0, -(strlen($extension) + 1)) : $path;

        foreach (['-compressed-compressed', '-compressed'] as $suffix) {
            foreach ([$extension, 'webp', 'jpg', 'jpeg', 'png'] as $candidateExtension) {
                if ($candidateExtension === '') {
                    continue;
                }

                $candidates[] = $base.$suffix.'.'.$candidateExtension;
            }
        }

        if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'], true)) {
            $candidates[] = $base.'.webp';
        }

        return array_values(array_unique($candidates));
    }

    public static function remoteUrl(string $path): string
    {
        $segments = array_map(
            fn (string $segment): string => rawurlencode($segment),
            explode('/', self::normalizePath($path)),
        );

        return 'https://akrightcity.com/en/'.implode('/', $segments);
    }

    public static function isRemote(string $path): bool
    {
        if (! self::isLegacyPath($path)) {
            return false;
        }

        return Str::startsWith($path, ['https://', 'http://', '/storage/legacy/']);
    }

    public static function isLegacyPath(string $path): bool
    {
        return Str::startsWith($path, [
            'https://akrightcity.com/en/',
            'http://akrightcity.com/en/',
            '/storage/legacy/',
            'images/',
            'reports/',
            'videos/',
            'documents/',
        ]);
    }

    public static function normalizePath(string $path): string
    {
        if (Str::startsWith($path, ['https://akrightcity.com/en/', 'http://akrightcity.com/en/'])) {
            $path = preg_replace('~^https?://akrightcity\.com/en/~', '', $path);
        }

        if (str_starts_with($path, '/storage/legacy/')) {
            $path = str_replace('/storage/legacy/', '', $path);
        }

        return ltrim(rawurldecode($path), '/');
    }

    public static function clearCache(): void
    {
        self::$resolved = [];
    }
}
