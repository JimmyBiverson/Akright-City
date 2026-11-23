<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LegacyController extends Controller
{
    public function redirect(Request $request, string $legacy): RedirectResponse
    {
        [$route, $parameters] = $this->resolveRedirect($legacy, $request->query('id'));

        return redirect()->route($route, $parameters);
    }

    /**
     * @return array{0: string, 1: array<string, string>}
     */
    private function resolveRedirect(string $legacy, mixed $id): array
    {
        $map = [
            'index' => ['home', []],
            'about' => ['about', []],
            'team' => ['team', []],
            'reports' => ['reports', []],
            'directory' => ['directory', []],
            'gallery' => ['gallery', []],
            'youtube' => ['youtube', []],
            'faqs' => ['faqs', []],
            'contact' => ['contact', []],
            'news' => ['news.index', []],
            'director' => ['about', []],
        ];

        if (array_key_exists($legacy, $map)) {
            return $map[$legacy];
        }

        if (str_starts_with($legacy, 'village_')) {
            return ['villages.show', ['slug' => str_replace('_', '-', str_replace('village_', '', $legacy))]];
        }

        if ($legacy === 'news_details' && (string) $id === '4') {
            return ['news.show', ['slug' => 'international-womens-day']];
        }

        return ['home', []];
    }
}
