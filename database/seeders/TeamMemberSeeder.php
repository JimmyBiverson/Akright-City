<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['group' => 'executive', 'name' => 'Simon Kaggwa', 'role' => 'President', 'location' => null, 'photo' => Asset::url('images/simon kaggwa.jpg'), 'sort_order' => 1],
            ['group' => 'executive', 'name' => 'Baker Nyakana', 'role' => 'Vice President', 'location' => null, 'photo' => Asset::url('images/bakernyakana.jpg'), 'sort_order' => 2],
            ['group' => 'executive', 'name' => 'Marion Nabifo', 'role' => 'Social Affairs Minister', 'location' => null, 'photo' => 'Photo', 'sort_order' => 3],
            ['group' => 'executive', 'name' => 'Nassir Mwanje', 'role' => 'Finance Minister', 'location' => null, 'photo' => Asset::url('images/nasirfinance.png'), 'sort_order' => 4],
            ['group' => 'executive', 'name' => 'Denis Kalyango', 'role' => 'Security Minister', 'location' => null, 'photo' => Asset::url('images/deniskalyango.jpg'), 'sort_order' => 5],
            ['group' => 'executive', 'name' => 'Allan Kiwumulo', 'role' => 'ICT Minister', 'location' => null, 'photo' => Asset::url('images/allankiwumulo.jpg'), 'sort_order' => 6],
            ['group' => 'executive', 'name' => 'Shyaka Mbanda', 'role' => 'Information Minister', 'location' => null, 'photo' => Asset::url('images/shyakambanda.jpg'), 'sort_order' => 7],
            ['group' => 'executive', 'name' => 'Denis Lubogo', 'role' => 'Environment Minister', 'location' => null, 'photo' => Asset::url('images/denislubogo.png'), 'sort_order' => 8],
            ['group' => 'executive', 'name' => 'Robert Mackay', 'role' => 'Legal Affairs Minister', 'location' => null, 'photo' => Asset::url('images/legalminister.jpg'), 'sort_order' => 9],
            ['group' => 'council', 'name' => 'Lutimba Matovu', 'role' => 'Chairperson', 'location' => 'Executive Village', 'photo' => Asset::url('images/lutimbamatovu.jpeg'), 'sort_order' => 1],
            ['group' => 'council', 'name' => 'Dr. Charles Katureebe', 'role' => 'Chairperson', 'location' => 'Diaspora Village', 'photo' => Asset::url('images/charleskatureebe.jpg'), 'sort_order' => 2],
            ['group' => 'council', 'name' => 'Arthur Mujuni', 'role' => 'Chairperson', 'location' => 'Green Terrace Village', 'photo' => 'Photo', 'sort_order' => 3],
            ['group' => 'council', 'name' => 'Daniel Ogongo', 'role' => 'Chairperson', 'location' => 'ICT Village', 'photo' => Asset::url('images/danielogong.jpg'), 'sort_order' => 4],
            ['group' => 'council', 'name' => 'Dorah Busuulwa', 'role' => 'Chairperson', 'location' => 'New World Village', 'photo' => 'Photo', 'sort_order' => 5],
            ['group' => 'council', 'name' => 'Ivan Ssenfuma Kanyike', 'role' => 'Chairperson', 'location' => 'Pearl Village', 'photo' => Asset::url('images/ivansenfuma.jpg'), 'sort_order' => 6],
            ['group' => 'council', 'name' => 'Mazinga Francis', 'role' => 'Chairperson', 'location' => 'Golf Course Executive', 'photo' => Asset::url('images/mazingagolf.png'), 'sort_order' => 7],
            ['group' => 'council', 'name' => 'Charles Mwirumubi', 'role' => 'Chairperson', 'location' => 'Rhine Village', 'photo' => Asset::url('images/charlesmwirumubi.jpg'), 'sort_order' => 8],
            ['group' => 'council', 'name' => 'Ronald Muteebi', 'role' => 'Chairperson', 'location' => 'Rendezvous Village', 'photo' => Asset::url('images/ronaldmutebi.png'), 'sort_order' => 9],
            ['group' => 'council', 'name' => 'Moses Nyonjo', 'role' => 'Chairperson', 'location' => 'Professional Village', 'photo' => Asset::url('images/mosesnyonjo.jpeg'), 'sort_order' => 10],
            ['group' => 'council', 'name' => 'Kirya David', 'role' => 'Chairperson', 'location' => 'California Village', 'photo' => Asset::url('images/davidkirya.jpg'), 'sort_order' => 11],
            ['group' => 'council', 'name' => 'Baker Nyakana', 'role' => 'Chairperson', 'location' => 'Sun City Village', 'photo' => null, 'sort_order' => 12],
            ['group' => 'conciliatory', 'name' => 'Dr. Charles Kanyesige', 'role' => 'Member', 'location' => 'Sun City Village', 'photo' => 'Photo', 'sort_order' => 1],
            ['group' => 'conciliatory', 'name' => 'Sarah Alinange', 'role' => 'Member', 'location' => 'Pearl Village', 'photo' => 'Photo', 'sort_order' => 2],
            ['group' => 'conciliatory', 'name' => 'Christine Monne', 'role' => 'Member', 'location' => 'Golf Course Executive', 'photo' => 'Photo', 'sort_order' => 3],
            ['group' => 'conciliatory', 'name' => 'Herbert Muhumuza', 'role' => 'Member', 'location' => 'Diaspora Village', 'photo' => 'Photo', 'sort_order' => 4],
            ['group' => 'conciliatory', 'name' => 'Molly Busiinge', 'role' => 'Member', 'location' => 'Professional Village', 'photo' => 'Photo', 'sort_order' => 5],
            ['group' => 'home-leadership', 'name' => 'Simon Kaggwa', 'role' => 'President', 'location' => null, 'photo' => Asset::url('images/simon kaggwa.jpg'), 'sort_order' => 1],
            ['group' => 'home-leadership', 'name' => 'Baker Nyakana', 'role' => 'Vice President', 'location' => null, 'photo' => Asset::url('images/bakernyakana.jpg'), 'sort_order' => 2],
            ['group' => 'home-leadership', 'name' => 'Marion Nabifo', 'role' => 'Social Affairs', 'location' => null, 'photo' => 'Photo', 'sort_order' => 3],
            ['group' => 'home-leadership', 'name' => 'Nassir Mwanje', 'role' => 'Finance Minister', 'location' => null, 'photo' => Asset::url('images/nasirfinance.png'), 'sort_order' => 4],
            ['group' => 'home-leadership', 'name' => 'Denis Kalyango', 'role' => 'Security Minister', 'location' => null, 'photo' => Asset::url('images/deniskalyango.jpg'), 'sort_order' => 5],
            ['group' => 'home-leadership', 'name' => 'Allan Kiwumulo', 'role' => 'ICT Minister', 'location' => null, 'photo' => Asset::url('images/allankiwumulo.jpg'), 'sort_order' => 6],
            ['group' => 'home-leadership', 'name' => 'Simon Kaggwa', 'role' => 'President', 'location' => null, 'photo' => Asset::url('images/simon kaggwa.jpg'), 'sort_order' => 7],
            ['group' => 'home-leadership', 'name' => 'Baker Nyakana', 'role' => 'Vice President', 'location' => null, 'photo' => Asset::url('images/bakernyakana.jpg'), 'sort_order' => 8],
            ['group' => 'home-leadership', 'name' => 'Kenneth Ssekimpi', 'role' => 'Infrastructure & Utilities', 'location' => null, 'photo' => Asset::url('images/kennethsekimpi.jpg'), 'sort_order' => 9],
            ['group' => 'home-leadership', 'name' => 'Marion Nabifo', 'role' => 'Social Affairs Minister', 'location' => null, 'photo' => 'Photo', 'sort_order' => 10],
            ['group' => 'home-leadership', 'name' => 'Nassir Mwanje', 'role' => 'Finance Minister', 'location' => null, 'photo' => 'Photo', 'sort_order' => 11],
            ['group' => 'home-leadership', 'name' => 'Denis Kalyango', 'role' => 'Security Minister', 'location' => null, 'photo' => 'Photo', 'sort_order' => 12],
            ['group' => 'home-leadership', 'name' => 'Allan Kiwumulo', 'role' => 'ICT Minister', 'location' => null, 'photo' => Asset::url('images/allankiwumulo.jpg'), 'sort_order' => 13],
            ['group' => 'home-leadership', 'name' => 'Denis Lubogo', 'role' => 'Environment Minister', 'location' => null, 'photo' => Asset::url('images/denislubogo.png'), 'sort_order' => 14],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}
