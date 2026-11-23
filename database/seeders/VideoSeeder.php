<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            ['8loU7Dy0G5E', 'Leadership Roundup with President Simon Kaggwa- July to date'],
            ['aYmlydSCU2A', 'Akright Football Fest 2026'],
            ['qZDHYfUzln0', 'Akright Business Profile- Cork & Barrel, Graviola Rd, Professional Village'],
            ['fGOhAOcotxc', "Investing in God's Kingdom- A call to action"],
            ['Tfz8bwPjNdw', 'Co-founder Alex Kamukama on President M7 visit for 20 years celebrations'],
            ['UUoBz2WBVOk', 'ICT Village chairman Hon Ogong Daniel on President M7 visit for 20years of Akright City'],
            ['uAoqVbGNStU', 'ACRA President Simon Kagwa on President M7 visit for 20years celebrations of Akright City'],
            ['-6qA6yUcluE', 'Security Minister ACRA 2026 Hon Kalyango on 20 years of Akright City'],
            ['iED8KDyI8F4', 'Environment Month Talk with Environmental scientist & Ex ACRA President Rtn Teddy G'],
            ['kX0GFMNcPoc', 'Akright Run brief'],
            ['zFHkR82FPj4', 'Akright Community Mid-Year Update 2026 | President Simon Kaggwa Speaks'],
            ['ce89Kb1lszA', 'Scenes from Akright Run 2026'],
        ];

        foreach ($videos as $index => [$videoId, $title]) {
            Video::updateOrCreate([
                'video_id' => $videoId,
            ], [
                'title' => $title,
                'url' => "https://www.youtube.com/watch?v={$videoId}",
                'sort_order' => $index + 1,
            ]);
        }
    }
}
