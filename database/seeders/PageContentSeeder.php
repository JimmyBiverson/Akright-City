<?php

namespace Database\Seeders;

use App\Models\PageContent;
use App\Support\LegacyAsset;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => [
                'title' => 'Welcome to Akright City',
                'subtitle' => 'Empowering our community, one story at a time.',
                'hero_image' => LegacyAsset::url('images/slide1.jpeg'),
                'data' => [
                    'slides' => [
                        ['title' => 'Akright Run 2026', 'subtitle' => 'Unity in Motion.', 'cta' => 'Join the Association', 'image' => LegacyAsset::url('images/akrightrun2026.jpeg')],
                        ['title' => 'Akright Run 2026', 'subtitle' => 'Unity in Motion.', 'cta' => 'Join the Association', 'image' => LegacyAsset::url('images/akrightrun2026b.jpeg')],
                        ['title' => 'Akright Run 2026', 'subtitle' => 'Unity in Motion.', 'cta' => 'Join the Association', 'image' => LegacyAsset::url('images/akrightrun2026c.jpeg')],
                        ['title' => 'Welcome to Akright City', 'subtitle' => 'Empowering our community, one story at a time.', 'cta' => 'Join the Association', 'image' => LegacyAsset::url('images/slide1.jpeg')],
                        ['title' => 'Our Community Heartbeat', 'subtitle' => 'Sharing messages, uplifting voices, and showcasing amazing work.', 'cta' => 'Learn More', 'image' => LegacyAsset::url('images/slide2.jpeg')],
                        ['title' => 'Shining Brighter Together', 'subtitle' => 'Adding value, elevating businesses, and inspiring our children.', 'cta' => 'Contact Us', 'image' => LegacyAsset::url('images/slide3.jpeg')],
                    ],
                    'mission' => 'To empower our community, elevate local businesses, and inspire our children.',
                    'vision' => 'A safe, vibrant, and sustainable environment where every resident thrives.',
                    'values' => ['Community First', 'Transparency', 'Inclusivity', 'Integrity'],
                    'quick_links' => [
                        ['label' => 'Reports & Documents', 'route' => 'reports'],
                        ['label' => 'Community Directory', 'route' => 'directory'],
                        ['label' => 'Recent Updates & News', 'route' => 'news.index'],
                        ['label' => 'Frequently Asked Questions', 'route' => 'faqs'],
                    ],
                    'gallery' => [
                        'title' => 'Gallery',
                        'subtitle' => 'Community Moments',
                        'image' => LegacyAsset::url('images/gallery.jpg'),
                    ],
                ],
                'meta_description' => 'Akright City Residents Association - Empowering our community, one story at a time.',
            ],
            'president' => [
                'title' => 'Message from the President',
                'subtitle' => 'Simon Kaggwa ACRA President - 2026',
                'hero_image' => LegacyAsset::url('images/president.jpg'),
                'body_html' => <<<'HTML'
<p>"Welcome to the New Akright City Website where we shall empower our Community..."</p><p>This platform is the heartbeat of Akright City, sharing stories, elevating businesses, and inspiring our children. Let's make Akright City shine brighter together.</p>
HTML,
                'data' => [
                    'intro' => '"Welcome to the New Akright City Website where we shall empower our Community..."',
                    'body' => "This platform is the heartbeat of Akright City, sharing stories, elevating businesses, and inspiring our children. Let's make Akright City shine brighter together.",
                    'signature_name' => 'Simon Kaggwa',
                    'signature_role' => 'ACRA President - 2026',
                ],
                'meta_description' => 'Message from the ACRA President.',
            ],
            'about' => [
                'title' => 'About Us',
                'subtitle' => 'Learn about our history, mission, and the team leading the way.',
                'hero_image' => LegacyAsset::url('images/aboutimg1.jpg'),
                'body_html' => <<<'HTML'
<h2>Who We Are</h2><p>The Akright City Residents Association (ACRA) is the heartbeat of our community.</p><p>Established to foster a sense of belonging and ensure the well-being of all residents, ACRA has been a cornerstone of Akright City's development. Since our inception, we have worked tirelessly to improve security, infrastructure, and social cohesion, creating a model community in Uganda.</p><h2>Our Mission</h2><p>To empower our community, elevate local businesses, and inspire our children by creating a safe, vibrant, and sustainable environment for all.</p><h2>Our Vision</h2><p>A safe, vibrant, and sustainable environment where every resident thrives and feels a deep sense of belonging.</p><h2>Our Values</h2><ul><li>Community First</li><li>Transparency</li><li>Inclusivity</li><li>Integrity</li></ul>
HTML,
                'data' => [
                    'president_name' => 'Simon Kagwa',
                    'president_role' => 'President, ACRA 2026',
                    'president_message' => <<<'HTML'
<p>"Dear Akright City neighbours,</p><p>Welcome to Akright City, a vibrant and well-planned community designed for quality living.</p><p>Akright City is more than an estate — it is a distinctive residential and commercial community built around safety, organization, and a high standard of living.</p><p>Located in Bwebajja along Entebbe Road, Akright City is a quickly developing neighborhood that sits gracefully on a beautiful green hill, with wonderful panoramic views on all sides and proximity to key transport links, including the Kampala-Entebbe Expressway and Entebbe International Airport. Its elevated position offers fresh air, open skies, and breathtaking sunsets, creating a calm and inspiring environment that residents and visitors immediately appreciate.</p><p>Beyond its natural beauty, Akright City holds a unique and important distinction, having been designated a United Nations International Residential Zone in 2025, making it a preferred location for UN officials and international residents. This designation reinforces our commitment to maintaining a strong security framework, reliable utilities and modern infrastructure in Akright City.</p><p>Through the Akright City Residents Association (ACRA), residents work collaboratively with elected and voluntary community leaders, businesses, and stakeholders to preserve and enhance these standards. Our guiding theme for 2026, “Aspiring for a Higher Standard,” reflects our commitment to continuous improvement — not only in infrastructure and services, but also in community values, responsibility, and engagement.</p><p>This website serves as your gateway to Akright City. Here, you will find community updates, events, guidelines, and opportunities to engage with ACRA. Whether you are a resident, a visitor or a stakeholder, we invite you to explore, connect, and engage with our community that takes great pride in where it lives and how it grows.</p><p>We are pleased to welcome you to Akright City — a place of beauty, security, and opportunity.</p><p>— Simon Kagwa</p><p>President, Akright City Residents Association (ACRA) | 2026</p>
HTML,
                    'vision_title' => "President's Vision 2026",
                    'vision_subtitle' => 'President Simon Kaggwa presents his vision for 2026',
                    'vision_videos' => ['hsMudtzYc2A', 'z4694WDA3Xg'],
                ],
                'meta_description' => 'Learn about the Akright City Residents Association.',
            ],
            'team' => [
                'title' => 'Meet Our Leadership',
                'subtitle' => 'The dedicated individuals working to make Akright City a better place.',
                'body_html' => <<<'HTML'
<h2>Executive Committee</h2><p>Our dedicated executive team leading the association.</p><h2>Council Members</h2><p>Village Chairpersons forming the Council.</p><h2>Conciliatory Committee</h2><p>Ensuring harmony and conflict resolution.</p>
HTML,
                'meta_description' => 'Meet the ACRA leadership team.',
            ],
            'reports' => [
                'title' => 'Reports',
                'subtitle' => 'Annual reports, financial statements, and community updates.',
                'meta_description' => 'ACRA annual reports and financial statements.',
            ],
            'directory' => [
                'title' => 'Community Directory',
                'subtitle' => 'Useful contacts and services within Akright City.',
                'meta_description' => 'Useful contacts and services within Akright City.',
            ],
            'news' => [
                'title' => 'Recent News & Updates',
                'subtitle' => 'Stay informed with the latest happenings in Akright City.',
                'meta_description' => 'Recent news and updates from Akright City.',
            ],
            'faqs' => [
                'title' => 'Frequently Asked Questions',
                'subtitle' => 'Answers to common questions about Akright City.',
                'meta_description' => 'Answers to common questions about Akright City.',
            ],
            'gallery' => [
                'title' => 'Community Gallery',
                'subtitle' => 'Celebrating moments and milestones in Akright City.',
                'data' => [
                    'empty_years' => [
                        '2025' => 'No photos uploaded for 2025 yet.',
                        '2024' => 'No photos uploaded for 2024 yet.',
                    ],
                ],
                'meta_description' => 'Community moments and milestones in Akright City.',
            ],
            'youtube' => [
                'title' => 'Our Youtube Channel',
                'subtitle' => 'Watch our latest community events, updates, and stories.',
                'meta_description' => 'Watch ACRA community events, updates, and stories.',
                'data' => [
                    'channel_url' => 'https://www.youtube.com/@AkrightCityTV',
                    'channel_label' => 'Visit Our Youtube Channel',
                ],
            ],
            'contact' => [
                'title' => 'Get in Touch',
                'subtitle' => "We'd love to hear from you. Reach out for any inquiries.",
                'body_html' => <<<'HTML'
<h2>Contact Information</h2><p><strong>Akright Community Residents Association</strong></p><p><strong>Address</strong><br>Mustard Street House No.8,<br>P.O. BOX 700038, Entebbe</p><p><strong>Contacts</strong><br>Tel (256) 772 618214</p><p><strong>Email:</strong><br>info@akrightcity.com</p><h2>Office Hours</h2><p>Monday - Friday: 9:00 AM - 5:00 PM<br>Saturday: 10:00 AM - 2:00 PM<br>Sunday: Closed</p>
HTML,
                'data' => [
                    'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.601619249993!2d32.51950975764921!3d0.16975133869147663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177d9a6ff2579069%3A0x56a9325c1fc5b62e!2sAkright%20City!5e0!3m2!1sen!2sug!4v1771011803840!5m2!1sen!2sug',
                ],
                'meta_description' => 'Contact the Akright City Residents Association.',
            ],
            'footer' => [
                'title' => 'Empowering our Community, one Story at a Time.',
                'body_html' => <<<'HTML'
<p>Akright City, Entebbe Road</p><p>info@akrightcity.com</p>
HTML,
                'data' => [
                    'copyright' => '© 2025 Akright City Residents Association. All Rights Reserved.',
                    'links' => ['About Us', 'Services', 'Gallery'],
                    'quick_links' => [
                        ['label' => 'Reports', 'route' => 'reports'],
                        ['label' => 'Directory', 'route' => 'directory'],
                        ['label' => 'News', 'route' => 'news.index'],
                        ['label' => 'FAQs', 'route' => 'faqs'],
                    ],
                ],
            ],
        ];

        foreach ($pages as $key => $page) {
            PageContent::firstOrCreate(['key' => $key], $page);
        }
    }
}
