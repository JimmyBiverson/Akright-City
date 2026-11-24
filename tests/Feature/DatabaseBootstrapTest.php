<?php

namespace Tests\Feature;

use App\Models\PageContent;
use Database\Seeders\BootstrapSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class DatabaseBootstrapTest extends TestCase
{
    public function test_bootstrap_seeder_preserves_existing_page_edits_and_fills_missing_pages(): void
    {
        Artisan::call('migrate', [
            '--force' => true,
            '--no-interaction' => true,
        ]);

        PageContent::create([
            'key' => 'home',
            'title' => 'Admin Edited Home',
        ]);

        $this->seed(BootstrapSeeder::class);

        $this->assertSame('Admin Edited Home', PageContent::where('key', 'home')->value('title'));
        $this->assertNotNull(PageContent::where('key', 'footer')->first());
    }

    public function test_home_repairs_stale_sqlite_schema_and_seeds_required_content(): void
    {
        $databasePath = sys_get_temp_dir().'/akrightcity-bootstrap-'.Str::random(12).'.sqlite';
        touch($databasePath);

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', $databasePath);

        Schema::create('migrations', function ($table): void {
            $table->increments('id');
            $table->string('migration');
            $table->integer('batch');
        });

        foreach (glob(database_path('migrations/*.php')) as $migrationFile) {
            $migration = basename($migrationFile, '.php');

            if (str_contains($migration, 'repair_missing_site_tables')) {
                continue;
            }

            DB::table('migrations')->insert([
                'migration' => $migration,
                'batch' => 1,
            ]);
        }

        try {
            $response = $this->get('/');

            $response->assertOk();
            $this->assertTrue(Schema::hasTable('page_contents'));
            $this->assertSame('Welcome to Akright City', PageContent::where('key', 'home')->value('title'));
            $this->assertSame('Message from the President', PageContent::where('key', 'president')->value('title'));
            $this->assertNotNull(PageContent::where('key', 'footer')->first());
        } finally {
            DB::disconnect('sqlite');

            if (is_file($databasePath)) {
                unlink($databasePath);
            }
        }
    }
}
