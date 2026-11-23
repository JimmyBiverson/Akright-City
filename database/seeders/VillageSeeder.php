<?php

namespace Database\Seeders;

use App\Models\Village;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    public function run(): void
    {
        $villages = [];
        $body = <<<'HTML'
<h2>Achievements &amp; Overview</h2><p>Green Terrace Village is a small village located in the southern part of Akright City, where St. Mark Church (Protestant) is located.</p><p>Described by Dr. Kamugisha as a "village for undergraduates," most of the residents are young people who are trying to navigate life. It's a village with a shared vision where our culture is unity in diversity.</p><p>Most of our area comprises undeveloped plots, and we currently have a population of about 20 families.</p><h2>Plans for 2026</h2><ul><li>Fully lighting our village to enhance visibility and safety</li><li>Working on drainage systems for better environmental management</li><li>Strengthening established social and economic infrastructures</li><li>Improving security for all residents</li></ul>
HTML;
        $message = <<<'HTML'
<p>"I am only a team leader, leading my colleagues. Nothing should stand in our way as we put Green Terrace Village on top. Let's not compete with others but with ourselves. God Bless You."</p><p>Voice of Green Terrace</p>
HTML;
        $villages[] = [
            'slug' => 'green-terrace',
            'name' => 'Green Terrace Village',
            'tagline' => 'Unity in Diversity',
            'chairperson' => 'Mr. Mujuni Arthur',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/greenterrace.jpeg'),
            'card_image' => Asset::url('images/village (1).jpeg'),
            'gallery_images' => [],
            'sort_order' => 1,
        ];

        $body = <<<'HTML'
<h2>Achievements &amp; Overview</h2><p>New World Village is the fastest growing community, bordering Akright City from the Ssekiwunga side, stretching up to HAM Villas and the Highway Express.</p><p>Our people are community-driven, with over 70 homes and growing. We value Religion, Culture, Education, Health and Wellness, and Community togetherness.</p><h3>Key Achievements</h3><ul><li>Tarmacking roads like Neem Rise and Chocolate Palm Rise</li><li>Improving drainage systems on Bottle Brush and Borassus Palm streets</li><li>Held well-attended Environmental care and cleaning initiatives (Bulungi bwa Nsi)</li><li>Development of 2 schools serving our community</li><li>Active Football Team ⚽</li></ul><h2>Plans for 2026</h2><ul><li>Street lighting installation</li><li>Continued road and drainage improvements</li><li>Fostering a well-organized and connected community</li></ul>
HTML;
        $message = <<<'HTML'
<blockquote>"AKRIGHT MY HOME, MY CITY. TOGETHER WE CAN 💪🏽"</blockquote>
HTML;
        $villages[] = [
            'slug' => 'new-world',
            'name' => 'New World Village',
            'tagline' => 'The Fastest Growing Community',
            'chairperson' => 'Dorah Busuulwa Nalongo',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/newworld.jpeg'),
            'card_image' => Asset::url('images/village (2).jpeg'),
            'gallery_images' => [],
            'sort_order' => 2,
        ];

        $body = <<<'HTML'
<h2>Achievements &amp; Overview</h2><p>Suncity Village is nestled in the hearts of Akright Estate, stretching from Royal Palm Road to Cane Palm Avenue. Boasting the prestigious Akright Golf Course and Golf Club, our village is a haven for sports and nature lovers.</p><p>With lush green spaces, solar-powered street lights, and a population of approximately 120 residents in 38 households, we offer a perfect blend of modern amenities and natural beauty.</p><h3>Highlights</h3><ul><li><strong>Solar Powered:</strong> Safe and serene living with solar-powered street lights.</li><li><strong>Golf Course:</strong> Home to a world-class golf course and football field.</li><li><strong>Infrastructure:</strong> Tarmac roads perfect for evening drives or morning jogs.</li></ul><h2>Plans for 2026</h2><ul><li><strong>Suncity Community Tree-Planting:</strong> Scheduled for Q2 2026 to enhance our green cover.</li><li>Maintaining solar street lighting infrastructure.</li><li>Enhancing sports facilities for youth engagement.</li><li>Continued road maintenance and beautification.</li></ul>
HTML;
        $message = <<<'HTML'
<p>"On behalf of Suncity Village, I warmly welcome you to our little corner of paradise. We're proud of our beautiful golf course, vibrant community, and commitment to environmental stewardship. We look forward to sharing our village with you and invite you to experience the best of Suncity Village."</p>
HTML;
        $villages[] = [
            'slug' => 'suncity',
            'name' => 'Suncity Village',
            'tagline' => 'A Vibrant Community',
            'chairperson' => 'Baker Nyakaana',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/suncity.jpeg'),
            'card_image' => Asset::url('images/village (3).jpeg'),
            'gallery_images' => [
                Asset::url('images/village_galleries/suncity/WhatsApp Image 2026-02-08 at 11.49.32 AM.jpeg'),
                Asset::url('images/village_galleries/suncity/WhatsApp Image 2026-02-08 at 11.49.33 AM.jpeg'),
                Asset::url('images/village_galleries/suncity/WhatsApp Image 2026-02-08 at 11.49.34 AM (1).jpeg'),
                Asset::url('images/village_galleries/suncity/WhatsApp Image 2026-02-08 at 11.49.35 AM.jpeg'),
                Asset::url('images/village_galleries/suncity/WhatsApp Image 2026-02-08 at 11.49.36 AM.jpeg'),
                Asset::url('images/village_galleries/suncity/village (1).jpeg'),
            ],
            'sort_order' => 3,
        ];

        $body = <<<'HTML'
<h2>Overview</h2><p>As we step into 2026, we are committed to building an even better community together. Only through working as a team, supporting each other, can we make our estate better.</p><p>We believe in the power of collective effort to transform our living space into a model of safety, cleanliness, and harmony.</p><h2>Key Focus Areas for 2026</h2><ul><li><strong>Roads &amp; Drainage:</strong> Regular maintenance to ensure accessibility and sanitation.</li><li><strong>Security:</strong> Installing and maintaining improved street lighting.</li><li><strong>Waste Management:</strong> Addressing police roadside rubbish dumping.</li><li><strong>Community Engagement:</strong> Boosting participation in village activities.</li></ul>
HTML;
        $message = <<<'HTML'
<p>"Thank you for your cooperation and support over the past year. Looking forward to building an even better community together in the year ahead. Wishing you all a Prosperous 2026."</p>
HTML;
        $villages[] = [
            'slug' => 'ict',
            'name' => 'ICT Village',
            'tagline' => 'Building a Better Community',
            'chairperson' => 'Daniel Ogong',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => null,
            'card_image' => Asset::url('images/village (5).jpeg'),
            'gallery_images' => [
                Asset::url('images/village_galleries/ict/card1.jpg'),
                Asset::url('images/village_galleries/ict/card2.jpg'),
                Asset::url('images/village_galleries/ict/card3.jpg'),
            ],
            'sort_order' => 5,
        ];

        $body = <<<'HTML'
<h2>About Our Village</h2><p>Professional Village is a well-organized and growing community located in Akright City. It is home to professionals, entrepreneurs, and families, creating a responsible and goal-oriented environment.</p><p>Known for its calm surroundings, planned settlement, and commitment to orderly development, Professional Village continues to attract residents seeking a secure and dignified place to live.</p><h2>2026 Projects</h2><ul><li><strong>Infrastructure:</strong> Improving village road access.</li><li><strong>Security:</strong> Enhancing security measures for all residents.</li><li><strong>Sanitation:</strong> Strengthening drainage and sanitation systems.</li><li><strong>Environment:</strong> Promoting tree planting (fruits for each home).</li></ul>
HTML;
        $message = <<<'HTML'
<p>"My term emphasis is on TMI (Total Members Involvement). Much as we live in the same village, I feel there’s a need for every household to get involved in matters of the community. Together, we can build a safe, organized, and progressive community."</p><p>Voice of Professional Village</p>
HTML;
        $villages[] = [
            'slug' => 'professional',
            'name' => 'Professional Village',
            'tagline' => 'A Community of Excellence',
            'chairperson' => 'Mr. Moses Nyonjo',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/professional.jpeg'),
            'card_image' => Asset::url('images/village (6).jpeg'),
            'gallery_images' => [],
            'sort_order' => 6,
        ];

        $body = <<<'HTML'
<h2>The California Spirit</h2><p>As we step into 2026, the California Village residents are grateful for the vibrant Akright community we share. We are proud of our contributions and participation towards the overall collective achievements of the community.</p><p>Our hallmark is the spirit of neighborly kindness and responsible ownership.</p><h3>Village Values</h3><ul><li><strong>The Golden Rule:</strong> Treating neighbors with the respect they too would like to receive.</li><li><strong>Responsibility:</strong> Contributing to overall community achievements.</li></ul><h2>Community Commitments</h2><ul><li><strong>Community Guidelines:</strong> Consistently checking Akright events calendar and community updates.</li><li><strong>Staying Informed:</strong> Heightened communication with deputies and attending Akright meetings.</li><li><strong>Active Participation:</strong> Engaging in all Akright initiatives.</li></ul>
HTML;
        $message = <<<'HTML'
<p>"May your 2026 be filled with joy and new memories, bring peace and harmony to your home and heart. We look forward to another great year together!"</p>
HTML;
        $villages[] = [
            'slug' => 'california',
            'name' => 'California Village',
            'tagline' => '"New Year, new beginnings!"',
            'chairperson' => 'Kirya Stephen',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/california.jpeg'),
            'card_image' => Asset::url('images/village (4).jpeg'),
            'gallery_images' => [],
            'sort_order' => 4,
        ];

        $body = <<<'HTML'
<h2>Village Overview &amp; Team</h2><p>Rhine Village is one of the 12 distinct villages of Akright City, situated on the western part. It is comprised of calm and high-profile people, including prominent business and corporate figures.</p><p>The village has about 90 homesteads, with a significant number of residents having families in the Diaspora.</p><h3>Executive Committee 2026</h3><ul><li><strong>Susan Bingi</strong> (Vice Chair)</li><li>Alex Bolo, Douglas Kawalya</li><li>Dinah Ongol, Janet Bulya</li><li>Kentaro Patricia, Juliet Bantu</li><li>Paul Lutaaya</li></ul><h2>2026 Projects</h2><ul><li><strong>Street Lighting:</strong> Installation and maintenance.</li><li><strong>Drainage:</strong> Work ongoing on Sycamore, Amelia shrub, and Citrus streets.</li><li><strong>Security:</strong> Strengthening security at street level.</li><li><strong>Identification:</strong> Gate numbering and road signage.</li><li><strong>Greening:</strong> Planting trees and flowers.</li><li><strong>Cleanliness:</strong> 'Smart up' initiatives.</li></ul>
HTML;
        $message = <<<'HTML'
<p>"Through our community engagements, and together with my team, I have no doubt that all the unfinished work in 2025 will be completed in this year 2026 and in line with the overall objectives and aspirations of the ACRA leadership. Alluta continua!"</p>
HTML;
        $villages[] = [
            'slug' => 'rhine',
            'name' => 'Rhine Village',
            'tagline' => 'Western Sophistication',
            'chairperson' => 'Charles Mwirumubi',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => null,
            'card_image' => Asset::url('images/village (7).jpeg'),
            'gallery_images' => [],
            'sort_order' => 7,
        ];

        $body = <<<'HTML'
<h2>Village Overview</h2><p>Executive Village, also referred to as the "Model Village", is the face of Akright City. Virtually all Akright residents and visitors pass through it daily.</p><p>Our residents are mainly high fliers in politics, business, music, sports, and academia. Executive Village leads in most Akright City events and actively supports ACRA.</p><h3>Leadership 2026</h3><ul><li><strong>Vice Chair:</strong> Dr. William Mbabazi</li><li><strong>Treasurer:</strong> Queen Elizabeth Agaba</li><li><strong>Mobiliser:</strong> Enid Sabiiti</li></ul><h3>Street Representatives &amp; Network</h3><ul><li><strong>Pear Lane:</strong> Haj. Nassir Mwanje</li><li><strong>Apple Drive:</strong> Johnson Pande</li><li><strong>Podocarpus:</strong> Patrick Rutagwera</li><li><strong>Akright Rd:</strong> Alex Tito</li><li><strong>Mpafu Circuit:</strong> Muhamed Katusi</li><li><strong>Washingtonia:</strong> Methu Bagyenyi</li><li><strong>Alcaria:</strong> Patrick Ocailap</li></ul><p><strong>Our Streets:</strong> Akright Road, Alcaria Avenue, Pear Lane, Mpafu Circuit, Moringa Wise, Apple Rise, Podocarpus Road, Suya Road, Anatolia Road, Pine Avenue, Washingtonia Drive, Musizi Road, Cyprus Crescent, Jolis Rise.</p>
HTML;
        $message = <<<'HTML'
<p><strong>Motto: "See it, Say it, Sorted"</strong></p><p>"Through community engagement and awareness, we hope 2026 will bring more inclusive participation by residents in all ACRA or Akright wide activities for more improvements in our infrastructure and environment."</p>
HTML;
        $villages[] = [
            'slug' => 'executive',
            'name' => 'Executive Village',
            'tagline' => 'The Model Village',
            'chairperson' => 'RTN. Lutimba MATOVU',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/executive.jpeg'),
            'card_image' => Asset::url('images/village (8).jpeg'),
            'gallery_images' => [],
            'sort_order' => 8,
        ];

        $body = <<<'HTML'
<h2>Village Overview &amp; Plans</h2><p>Rendezvous Village of Akright City is comprised of over 200 plots lined up on Golf Course Rd, Suya Rd, Musizi Rd, etc. With a total of 137 registered members, the village is home for many dignified people.</p><h3>Priorities for 2026</h3><ul><li><strong>Drainage:</strong> Construct a drainage channel across Walnut Street down Echuya Rise to manage storm water.</li><li><strong>Engagement:</strong> Improve member participation in ACRA Programmes.</li><li><strong>Membership:</strong> Engage members to improve Annual Subscription.</li></ul><h2>Administrative Structure</h2><h3>Executive Committee</h3><ul><li><strong>Vice Chairperson:</strong> Mr. Kajuma Edwin</li><li><strong>Secretary:</strong> Mrs. Anyango Okwii Suzan</li><li><strong>Treasurer:</strong> Ms. Rowena Pearl</li></ul><h3>Street Representatives</h3><ul><li>Dr. Kisambu James (Mustard Street)</li><li>Mr. Edwin Kajuma (Budongo Rise)</li><li>Mr. Mbabazi Jackson (Busitema Rise)</li><li>Mr. Kiige Peter (Garry Road)</li><li>Mr. Peut Mercel (Bugoma Rise)</li><li>Mr. Mudonyi Paul (Adama Rise)</li><li>Mr. Nsubuga Paul (Walnut Avenue)</li><li>Mr. Rob Tieman (Ficus Boulevard)</li><li>Mrs. Obuko Jackie (Echuya Rise)</li><li>Ms. Sange Alice Flora (Suya Road)</li><li>Ms. Anyango Okwii Suzan (Kalinzu Rise)</li></ul>
HTML;
        $message = <<<'HTML'
<p>"I pray that we continue working together this Year 2026 to better our performance of the past years. The strategy is to have a Task to work on each year and we collaboratively contribute to complete it. We contribute more, we can do more. I thank you and wish you the best of Year 2026."</p>
HTML;
        $villages[] = [
            'slug' => 'rendezvous',
            'name' => 'Rendezvous Village',
            'tagline' => 'A Growing Community',
            'chairperson' => 'Mr. Ronald Mutebi',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/rendezvous.jpeg'),
            'card_image' => Asset::url('images/village (9).jpeg'),
            'gallery_images' => [],
            'sort_order' => 9,
        ];

        $body = <<<'HTML'
<h2>Achievements &amp; Overview</h2><p>Nestled like a radiant gem within its shell, Pearl Village is a refined residential community quietly surrounded by Executive, Professional, Sun City, New World, Rendezvous and Rhine villages.</p><p>With just about 100 occupied homes, this boutique community offers privacy, safety and a strong sense of belonging. Tree-lined streets, premium amenities and thoughtful planning make Pearl Village an ideal setting to raise a family, enjoy modern conveniences, and unwind in style.</p><h3>Key Features</h3><ul><li>Prestigious, low-density residential community (~100 homes)</li><li>Beautifully laid-out streets: Lower Podocarpus St., Alexandria Ave., Mango Ave., etc.</li><li>Home to a reputable International School</li><li>On-site shopping mall with supermarket, pharmacy and hair salon</li><li>Wellness spa/centre promoting healthy, balanced living</li><li>Furnished rental apartments &amp; Convenient hardware shop</li><li>A vibrant recreation winery offering entertainment</li><li>Calm, secure and family-friendly environment</li></ul><h2>Vision &amp; Plans (2026)</h2><p>We are focused on continuing to build a safe, welcoming, and progressive community.</p><h3>Planned Projects &amp; Activities</h3><ul><li>Village meetings to foster community dialogue</li><li>Community general cleaning initiatives</li><li>Security drills to ensure safety</li><li>Sports events for health and bonding</li><li>Social events to strengthen neighborly connections</li><li><em>Dates will be announced once agreed upon</em></li></ul>
HTML;
        $message = <<<'HTML'
<p>"Welcome to Pearl Village, a serene and well-planned residential community proudly located in Akright City, Bwebajja. Like a precious pearl within its shell, our village offers a peaceful, family-friendly environment while remaining closely connected to the conveniences and vibrancy of the city.</p><p>As Chairperson, I invite you to explore our community, engage with your neighbours, and take part in shaping a safe, welcoming and progressive Pearl Village. Together, through unity and shared responsibility, we continue to build a place not just to live, but to belong."</p><p>For God and My Country</p>
HTML;
        $villages[] = [
            'slug' => 'pearl',
            'name' => 'Pearl Village',
            'tagline' => 'A Hidden Gem for Refined Family Living & Leisure',
            'chairperson' => 'Mr. Ivan Senfuma',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/pearl.jpeg'),
            'card_image' => Asset::url('images/village (10).jpeg'),
            'gallery_images' => [
                Asset::url('images/village_galleries/pearl/WhatsApp Image 2026-02-11 at 1.24.16 PM.jpeg'),
                Asset::url('images/village_galleries/pearl/WhatsApp Image 2026-02-11 at 10.15.04 AM.jpeg'),
            ],
            'sort_order' => 10,
        ];

        $body = <<<'HTML'
<h2>Overview &amp; Location</h2><p><strong>DIASPORA VILLAGE</strong> shares the face of Akright City together with the Executive Village. While on Entebbe Road moving towards Entebbe International Airport, on your right, one cannot miss the eye-catching magnificent residential houses of Diaspora, in a prime location at the hill!</p><p>As one enters the city through the main gate, Diaspora Village straddles the hill on the right. True to its name “DIASPORA” most of its inhabitants actually live in the diaspora (outside the country). The village boasts of its stunning views of Kampala City, Lake Victoria, Kajjansi Air strip, Entebbe-Kampala Express way, Entebbe-Munyonyo bypass, and Entebbe Road.</p><p><strong>Roads:</strong> Akright Road, Church Road, Markhamia Crescent, Molucana Crescent, and Hill Lane.</p><p><strong>Landmarks:</strong> St Padero Pio Catholic Church, Kaburamuliro and Elite School of Science and Technology boarding the village.</p><h2>The 2026 Plan</h2><p>The following are proposed activities/projects:</p><ul><li><strong>Drainage system:</strong> Map storm water passages, engage and sensitize plot owners and construct some drainage channels.</li><li><strong>Security:</strong> Street lighting and Bush clearing.</li><li><strong>Infrastructure:</strong> Road maintenance, Gate numbering and signages.</li><li><strong>Community:</strong> Engagements (Get to know each other/social events).</li></ul><p><strong>Anticipated Funding:</strong> 70% remittances from annual subscriptions and fundraising drives. We hope to have a strong village committee made up of street/road representatives and a coordinator of the “Diaspora” community.</p><h3>Past Chairpersons</h3><ul><li>Rtn Habert Muhumuza (2018-2020)</li><li>Mr Julius Byaruhanga (2021)</li><li>Ms Peace Asubo (2022, 2023)</li><li>Mrs Anna Sekatawa (2024, 2025)</li></ul>
HTML;
        $message = <<<'HTML'
<p>During my tenure, I hope to be a resourceful member of the council, putting the interests of Diaspora Village first (<em>My Street, My Village, My City</em>). I will encourage and support the principles of Accountability, Transparency, Inclusiveness, Team Work and Community Engagement. I encourage ACRA to prioritize community mobilization and engagement so that everybody is brought at the table, living-no-one behind.</p>
HTML;
        $villages[] = [
            'slug' => 'diaspora',
            'name' => 'Diaspora Village',
            'tagline' => 'Shares the face of Akright City together with the Executive Village.',
            'chairperson' => 'Dr. Katureebe Charles',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => null,
            'card_image' => Asset::url('images/village (10).jpeg'),
            'gallery_images' => [],
            'sort_order' => 11,
        ];

        $body = <<<'HTML'
<h2>About Golf Course Executive Village</h2><p>Golf Course Executive (GCE) is one of the twelve villages that make up Akright City, an upscale residential community located midway between Kampala, Uganda's capital and largest city, and Entebbe, the historic peninsula city on the shores of Lake Victoria and home to Uganda's main international airport.</p><p>These amenities make GCE not only an excellent residential choice but also an ideal destination for leisure and competitive golfing, health walks, scenic views, and community gatherings.</p><h2>Location &amp; Boundaries</h2><p>GCE occupies the <strong>southern downhill area of Akright City</strong>. It is bordered:</p><ul><li>🧭 <strong>North:</strong> Sister villages of ICT, Sun City, and Rhine</li><li>🧭 <strong>South:</strong> Kisubi–Nakawuka Road</li><li>🧭 <strong>East:</strong> Kampala–Entebbe Expressway</li><li>🧭 <strong>West:</strong> Zain Road</li></ul><p>Most of GCE falls under the <em>Wamala and Kassala Local Council (LC1) areas in Sissa Sub-county, Wakiso District</em>.</p><h2>Key Amenities</h2><p><strong>⛳ Palm Valley Golf &amp; Country Club</strong></p><p>A beautifully maintained 9-hole course featuring manicured greens, lush fairways, forested islands, flowing streams, and scenic lakes.</p><p><strong>🌿 Ark Gardens</strong></p><p>A charming venue for small- to medium-sized community and family events.</p><p><strong>🚔 Akright City Police Station</strong></p><p>Provides convenient access to security services and enhances community safety.</p>
HTML;
        $message = '';
        $villages[] = [
            'slug' => 'golf-course',
            'name' => 'Golf Course Executive Village',
            'tagline' => 'Home of Palm Valley Golf & Country Club — Where Leisure Meets Community.',
            'chairperson' => 'Mazinga Francis',
            'chairperson_message' => $message,
            'body_html' => $body,
            'map_image' => Asset::url('images/maps/golfcourseexecutive.jpeg'),
            'card_image' => Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.50 PM.jpeg'),
            'gallery_images' => [
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.50 PM.jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.51 PM.jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.53 PM (1).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.53 PM (2).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.54 PM (2).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.54 PM (3).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.55 PM (1).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.55 PM (2).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.55 PM.jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.56 PM (1).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.56 PM (2).jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.56 PM.jpeg'),
                Asset::url('images/village_galleries/golf_course/WhatsApp Image 2026-02-14 at 7.21.57 PM.jpeg'),
            ],
            'sort_order' => 12,
        ];

        foreach ($villages as $village) {
            Village::updateOrCreate(['slug' => $village['slug']], $village);
        }
    }
}
