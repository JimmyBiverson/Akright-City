<?php

namespace App\Providers;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::define('access-admin', fn (User $user): bool => $user->role === 'admin');

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function (\Illuminate\View\View $view): void {
            $footerContent = once(function (): ?PageContent {
                if (! Schema::hasTable('page_contents')) {
                    return null;
                }

                return PageContent::where('key', 'footer')->first();
            });

            $faviconPath = public_path('favicon.ico');
            $faviconVersion = is_file($faviconPath) ? filemtime($faviconPath) : 0;

            $view->with([
                'footerContent' => $footerContent,
                'faviconUrl' => asset('favicon.ico').'?v='.$faviconVersion,
            ]);
        });
    }
}
