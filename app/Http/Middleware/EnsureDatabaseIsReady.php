<?php

namespace App\Http\Middleware;

use Closure;
use Database\Seeders\BootstrapSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class EnsureDatabaseIsReady
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->shouldBootstrap()) {
            return $next($request);
        }

        $lock = Cache::store('file')->lock('database-bootstrap', 120);

        $lock->block(10, function (): void {
            if (! $this->databaseNeedsBootstrap()) {
                return;
            }

            $this->ensureSqliteFileExists();

            try {
                Artisan::call('migrate', [
                    '--force' => true,
                    '--no-interaction' => true,
                ]);
                Artisan::call('db:seed', [
                    '--class' => BootstrapSeeder::class,
                    '--force' => true,
                    '--no-interaction' => true,
                ]);
            } catch (Throwable $exception) {
                report($exception);
            }
        });

        return $next($request);
    }

    private function shouldBootstrap(): bool
    {
        if (config('database.default') !== 'sqlite') {
            return false;
        }

        $database = config('database.connections.sqlite.database');

        if (! is_string($database) || $database === ':memory:') {
            return false;
        }

        $this->ensureSqliteFileExists();

        return $this->databaseNeedsBootstrap();
    }

    private function databaseNeedsBootstrap(): bool
    {
        try {
            return ! Schema::hasTable('page_contents');
        } catch (Throwable) {
            return true;
        }
    }

    private function ensureSqliteFileExists(): void
    {
        $database = config('database.connections.sqlite.database');

        if (! is_string($database) || $database === ':memory:' || is_file($database)) {
            return;
        }

        $directory = dirname($database);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        touch($database);
    }
}
