<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class NewsPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'acra-2026-year-planner',
                'title' => 'ACRA 2026 Year Planner: A Year Packed with Community Spirit',
                'published_at' => '2025-09-28',
                'image' => Asset::url('images/slide1.jpeg'),
                'excerpt' => 'Get ready for an unforgettable 2026 with ACRA! Join us for Akright Youth Day, Akright Women’s Day, Bulungi Bwansi service projects, and more.',
                'body_html' => '<p>Get ready for an unforgettable 2026 with ACRA! Join us for Akright Youth Day, Akright Women’s Day, Bulungi Bwansi service projects, and more.</p>',
                'link' => Asset::url('images/yearplanner.jpeg'),
                'link_label' => 'Read More →',
                'sort_order' => 1,
            ],
            [
                'slug' => 'acra-26-youth-fest',
                'title' => 'ACRA ‘26 Youth Fest. Come One Come All',
                'published_at' => '2026-01-24',
                'image' => Asset::url('images/gallery.jpg'),
                'excerpt' => 'The excitement is building as the ASBA ’26 Youth Fest draws near, promising an unforgettable day filled with energy, talent, and friendly competition.',
                'body_html' => '<p>The excitement is building as the ASBA ’26 Youth Fest draws near, promising an unforgettable day filled with energy, talent, and friendly competition.</p>',
                'link' => Asset::url('images/acrafestflyer.jpg'),
                'link_label' => 'Read More →',
                'sort_order' => 2,
            ],
            [
                'slug' => 'international-womens-day',
                'title' => "International Women's Day",
                'published_at' => '2026-02-19',
                'image' => Asset::url('images/uploads/1771537660_women.jpg'),
                'excerpt' => "Give to Gain This year, the International Women's Day celebration is themed Give to Gain Of the so many ways this theme can be customized, we are...",
                'body_html' => <<<'HTML'
<p>Give to Gain</p><p>This year, the International Women's Day celebration is themed Give to Gain</p><p>Of the so many ways this theme can be customized, we are choosing to break the ice in our community by giving one another access , one woman to another . It's time to come out of our shells and shine together. And what better way to do this than over some real good conversation... and food and wine plus music !? 🔥</p><p>The perfect opportunity for perfect conversation is on Women's day this year. Come, let's converse, let's get to know one another better. Who knows, maybe your next friend in need, your next customer, your next fellow mother in law, your next counselor, your next support may just be there.</p><p>Let's build this community paka kuwulira bubi. 💁🏽‍♀️😁</p><p>Prepare your entry of only UGX 80k per lady and let's do this. 💪🏽</p><p>Yours truly,<br>Marion Nabifo<br>Social Affairs Minister</p>
HTML,
                'link' => null,
                'link_label' => '← Back to News',
                'sort_order' => 3,
            ],
            [
                'slug' => 'co-founder-alex-kamukama-vision',
                'title' => 'Co-founder Rtn Alex Kamukama shares his Akright Vision',
                'published_at' => '2026-02-10',
                'image' => Asset::url('images/acra meeting Feb 10.jpg'),
                'excerpt' => 'In early February 2026, Akright City founders Dr. Anatoli and Rtn Alex Kamukama hosted the 2026 ACRA leadership team, led by President Simon Kagwa, for...',
                'body_html' => '<p>In early February 2026, Akright City founders Dr. Anatoli and Rtn Alex Kamukama hosted the 2026 ACRA leadership team, led by President Simon Kagwa, for...</p>',
                'link' => 'https://www.youtube.com/watch?v=YQ2t75DWtlA',
                'link_label' => 'Watch Video →',
                'sort_order' => 4,
            ],
            [
                'slug' => 'the-akright-city-run-2026',
                'title' => 'The Akright City Run 2026',
                'published_at' => '2026-04-28',
                'image' => Asset::url('images/uploads/1777328461_run22.jpg'),
                'excerpt' => 'The  Akright 2026 RUN  is Back & Bigger with the theme "Unganisha - Unity in Motion" on 9th May 2026 at DA2 Gardens, Akright City..',
                'body_html' => '<p>The  Akright 2026 RUN  is Back &amp; Bigger with the theme <strong>"Unganisha - Unity in Motion"</strong> on 9th May 2026 at DA2 Gardens, Akright City..</p>',
                'link' => Asset::url('images/akrightrun.jpeg'),
                'link_label' => 'Read More →',
                'sort_order' => 5,
            ],
        ];

        foreach ($posts as $post) {
            NewsPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
