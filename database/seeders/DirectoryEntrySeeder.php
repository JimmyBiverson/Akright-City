<?php

namespace Database\Seeders;

use App\Models\DirectoryEntry;
use Illuminate\Database\Seeder;

class DirectoryEntrySeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            ['category' => 'Schools', 'name' => 'St Marcelino International School', 'address' => 'St Marcelino Akright, Bwebajja Plot 4 Akright Estate Avocado Road', 'phone' => '0755520326', 'email' => 'stmarcelinoakright10@gmail.com', 'website' => 'https://stmarcelinointernationalschool.com/', 'details' => null, 'sort_order' => 1],
            ['category' => 'Schools', 'name' => 'St Louis Pre & Primary School', 'address' => "Primary: Near Golf Course Executive Village, Wamala Road\nPre-Primary: Rendezvous Village near Cornerstone church", 'phone' => '+256 744 230 832 / +256 772 467 288', 'email' => 'info@stlouispreandprimaryschool.com', 'website' => 'https://stlouispreandprimaryschool.com/', 'details' => null, 'sort_order' => 2],
            ['category' => 'Restaurants & Bars', 'name' => 'Palm Valley Golf Club', 'address' => 'Akright Kakungulu Estate, off Entebbe Road (at Bwebajja)', 'phone' => '+256 708127781', 'email' => null, 'website' => 'https://golf-uganda.com/palm-valley-golf-and-country-club/', 'details' => null, 'sort_order' => 1],
            ['category' => 'Restaurants & Bars', 'name' => 'Harkis Wines & Spirits', 'address' => 'Located in Akright City, Pearl Village', 'phone' => '+1 (347) 224-7821', 'email' => 'harkisswines@gmail.com', 'website' => 'https://harkisswines.com/', 'details' => null, 'sort_order' => 2],
            ['category' => 'Restaurants & Bars', 'name' => 'DA-2 Koi Gardens & Restaurant', 'address' => 'Akright City Hill Top, Bwebajja, Entebbe Road', 'phone' => '+256 778 607873', 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 3],
            ['category' => 'Churches / Mosque', 'name' => 'St Mark Church Sekiwunga', 'address' => 'Anglican Church, Entebbe Archdeaconry', 'phone' => '+256 776 840 606', 'email' => null, 'website' => null, 'details' => 'Services: English (9am), Luganda (11am)', 'sort_order' => 1],
            ['category' => 'Churches / Mosque', 'name' => 'Kabulamuliro Catholic Church', 'address' => 'Kabulamuliro, Bwebajja off Entebbe Road', 'phone' => '+256 755 604 973 / +256 772 604 973', 'email' => null, 'website' => null, 'details' => 'Services: English (9am), Luganda (11am)', 'sort_order' => 2],
            ['category' => 'Churches / Mosque', 'name' => 'Masjid Akright', 'address' => 'Akright City', 'phone' => null, 'email' => null, 'website' => null, 'details' => 'Details coming soon.', 'sort_order' => 3],
            ['category' => 'Services & Retail', 'name' => 'Akright Supermarket', 'address' => 'Pearl Village', 'phone' => '+256 774 237 072', 'email' => null, 'website' => null, 'details' => 'Open: Mon-Sun, 9am - 10pm', 'sort_order' => 1],
            ['category' => 'Services & Retail', 'name' => 'Vintage Pharmacy', 'address' => 'Akright Estate Main Stage & Akright Supermarket, Bwebajja', 'phone' => null, 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 2],
            ['category' => 'Utilities', 'name' => 'National Water', 'address' => null, 'phone' => '0751121346', 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 1],
            ['category' => 'Utilities', 'name' => 'UEDCL', 'address' => null, 'phone' => '0800 285 285, 0800 203 088', 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 2],
            ['category' => 'Utilities', 'name' => 'Uganda Police', 'address' => null, 'phone' => '0781 623 680, 0777 925 703, 0785 828 317', 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 3],
            ['category' => 'Sports & Recreation', 'name' => 'Ham Sports Arena', 'address' => 'Plot 1636 Block 405 Akright City', 'phone' => null, 'email' => null, 'website' => null, 'details' => null, 'sort_order' => 1],
        ];

        foreach ($entries as $entry) {
            DirectoryEntry::create($entry);
        }
    }
}
