<?php

namespace App\Providers;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
            $view->with('footerContent', PageContent::where('key', 'footer')->first());
        });
    }
}
