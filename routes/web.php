<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LegacyController;
use App\Http\Controllers\SiteController;
use App\Models\NewsPost;
use App\Models\Village;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/team', [SiteController::class, 'team'])->name('team');
Route::get('/villages', [SiteController::class, 'villages'])->name('villages.index');
Route::get('/villages/{slug}', [SiteController::class, 'village'])->name('villages.show');
Route::get('/reports', [SiteController::class, 'reports'])->name('reports');
Route::get('/directory', [SiteController::class, 'directory'])->name('directory');
Route::get('/news', [SiteController::class, 'news'])->name('news.index');
Route::get('/news/{slug}', [SiteController::class, 'newsPost'])->name('news.show');
Route::get('/faqs', [SiteController::class, 'faqs'])->name('faqs');
Route::get('/gallery', [SiteController::class, 'gallery'])->name('gallery');
Route::get('/youtube', [SiteController::class, 'youtube'])->name('youtube');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/payments', [SiteController::class, 'payments'])->name('payments');

Route::get('/sitemap.xml', function () {
    $urls = collect([
        route('home'),
        route('about'),
        route('team'),
        route('villages.index'),
        route('reports'),
        route('directory'),
        route('news.index'),
        route('faqs'),
        route('gallery'),
        route('youtube'),
        route('contact'),
        route('payments'),
    ])
        ->merge(Village::pluck('slug')->map(fn (string $slug): string => route('villages.show', $slug)))
        ->merge(NewsPost::pluck('slug')->map(fn (string $slug): string => route('news.show', $slug)));

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

    foreach ($urls as $url) {
        $xml .= '<url><loc>'.e($url).'</loc></url>'."\n";
    }

    $xml .= '</urlset>'."\n";

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    });

    Route::middleware(['auth', 'can:access-admin'])->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/content/{resource}', [ContentController::class, 'index'])->name('content.index');
        Route::get('/content/{resource}/create', [ContentController::class, 'create'])->name('content.create');
        Route::post('/content/{resource}', [ContentController::class, 'store'])->name('content.store');
        Route::get('/content/{resource}/{id}/edit', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('/content/{resource}/{id}', [ContentController::class, 'update'])->name('content.update');
        Route::delete('/content/{resource}/{id}', [ContentController::class, 'destroy'])->name('content.destroy');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    });
});

Route::get('/{legacy}.php', [LegacyController::class, 'redirect'])
    ->where('legacy', '[a-z0-9_]+')
    ->name('legacy');
