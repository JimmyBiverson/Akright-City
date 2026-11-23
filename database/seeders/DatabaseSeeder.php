<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@akrightcity.com')],
            [
                'name' => env('ADMIN_NAME', 'ACRA Administrator'),
                'password' => env('ADMIN_PASSWORD', 'ChangeMe123!'),
                'role' => 'admin',
            ],
        );

        $this->call([
            PageContentSeeder::class,
            VillageSeeder::class,
            TeamMemberSeeder::class,
            DirectoryEntrySeeder::class,
            NewsPostSeeder::class,
            ReportSeeder::class,
            GalleryImageSeeder::class,
            VideoSeeder::class,
            FaqSeeder::class,
            PartnerSeeder::class,
        ]);
    }
}
