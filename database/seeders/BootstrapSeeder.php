<?php

namespace Database\Seeders;

use App\Models\DirectoryEntry;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\NewsPost;
use App\Models\Partner;
use App\Models\Report;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\Video;
use App\Models\Village;
use Illuminate\Database\Seeder;

class BootstrapSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PageContentSeeder::class);
        $this->callIfTableIsEmpty(Village::class, VillageSeeder::class);
        $this->callIfTableIsEmpty(TeamMember::class, TeamMemberSeeder::class);
        $this->callIfTableIsEmpty(DirectoryEntry::class, DirectoryEntrySeeder::class);
        $this->callIfTableIsEmpty(NewsPost::class, NewsPostSeeder::class);
        $this->callIfTableIsEmpty(Report::class, ReportSeeder::class);
        $this->callIfTableIsEmpty(GalleryImage::class, GalleryImageSeeder::class);
        $this->callIfTableIsEmpty(Video::class, VideoSeeder::class);
        $this->callIfTableIsEmpty(Faq::class, FaqSeeder::class);
        $this->callIfTableIsEmpty(Partner::class, PartnerSeeder::class);
        $this->createAdminIfMissing();
    }

    private function callIfTableIsEmpty(string $modelClass, string $seederClass): void
    {
        if ($modelClass::query()->exists()) {
            return;
        }

        $this->call($seederClass);
    }

    private function createAdminIfMissing(): void
    {
        $password = config('admin.password');

        if (! is_string($password) || $password === '') {
            return;
        }

        if (User::query()->where('role', 'admin')->exists()) {
            return;
        }

        User::updateOrCreate(
            ['email' => config('admin.email')],
            [
                'name' => config('admin.name'),
                'password' => $password,
                'role' => 'admin',
            ],
        );
    }
}
