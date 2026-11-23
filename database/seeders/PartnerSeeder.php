<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['MTN', 'images/logos/mtn.jpg'],
            ['Pepsi', 'images/logos/pepsi.png'],
            ['Movit', 'images/logos/movit.png'],
            ['Roke Telkom', 'images/logos/roke.jpg'],
            ['Jolis', 'images/logos/jolis.jpg'],
            ['harkiss', 'images/logos/harkiss.jpg'],
            ['St Marcelino', 'images/logos/stmarcelino.png'],
            ['Sukie', 'images/logos/sukie.png'],
            ['GF Forex', 'images/logos/gfforex.jpg'],
            ['Grundstein', 'images/logos/grundstein.jpg'],
            ['Jibs', 'images/logos/jibs.jpg'],
            ['Junior Years', 'images/logos/junioryears.jpg'],
            ['St Louis', 'images/logos/stlouis.jpg'],
        ];

        foreach ($partners as $index => [$name, $logo]) {
            Partner::create([
                'name' => $name,
                'logo' => Asset::url($logo),
                'sort_order' => $index + 1,
            ]);
        }
    }
}
