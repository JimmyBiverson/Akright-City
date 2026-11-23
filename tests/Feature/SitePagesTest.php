<?php

namespace Tests\Feature;

use App\Models\NewsPost;
use App\Models\PageContent;
use App\Models\Village;
use App\Support\HeroImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_village_and_news_content(): void
    {
        $this->seedBaseContent();

        Village::factory()->create([
            'slug' => 'green-terrace',
            'name' => 'Green Terrace Village',
        ]);

        NewsPost::factory()->create([
            'slug' => 'the-akright-city-run-2026',
            'title' => 'The Akright City Run 2026',
            'published_at' => now(),
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Welcome to Akright City')
            ->assertSee('Green Terrace')
            ->assertSee('The Akright City Run 2026')
            ->assertSee('Frequently Asked Questions');
    }

    public function test_village_page_renders_village_details(): void
    {
        $this->seedBaseContent();

        $village = Village::factory()->create([
            'slug' => 'suncity',
            'name' => 'Suncity Village',
            'chairperson' => 'Test Chairperson',
        ]);

        $this->get(route('villages.show', $village->slug))
            ->assertOk()
            ->assertSee('Suncity Village')
            ->assertSee('Test Chairperson');
    }

    public function test_payments_page_renders_local_payment_content(): void
    {
        $this->seedBaseContent();

        $this->get(route('payments'))
            ->assertOk()
            ->assertSee('Pay your ACRA subscription securely through the official Akright City payment portal.')
            ->assertSee('Open Secure Payment Form')
            ->assertSee('https://my.akrightcity.com/?dad=index&amp;jc=order&amp;a=form&amp;package=79', false);
    }

    public function test_home_page_renders_responsive_navigation_structure(): void
    {
        $this->seedBaseContent();
        Village::factory()->create([
            'slug' => 'suncity',
            'name' => 'Suncity Village',
        ]);

        $this->assertFileExists(public_path('acra-logo-header.png'));
        $this->assertSame('image/png', getimagesize(public_path('acra-logo-header.png'))['mime']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('class="site-header"', false)
            ->assertDontSee('is-solid', false)
            ->assertSee('id="mobile-navigation"', false)
            ->assertSee('data-mobile-submenu-toggle', false)
            ->assertSee('class="mega-menu narrow" id="menu-team"', false)
            ->assertSee('class="mega-menu narrow" id="menu-villages"', false)
            ->assertSee('class="mega-menu narrow" id="menu-help"', false)
            ->assertDontSee('class="mega-menu" id="menu-villages"', false)
            ->assertSee('Suncity', false)
            ->assertSee('acra-logo-header.png', false)
            ->assertSee('Payments');
    }

    public function test_hero_images_use_optimized_local_variants(): void
    {
        $this->seedBaseContent();
        $home = PageContent::where('key', 'home')->firstOrFail();
        $data = $home->data;
        $data['slides'][0]['image'] = 'https://akrightcity.com/en/images/slide1.jpeg';
        $home->update(['data' => $data]);

        $this->assertSame('slide1.webp', HeroImage::imagePathFor($data['slides'][0]['image']));

        $created = [];

        foreach (['hero/slide1.webp', 'hero/slide1-thumb.webp'] as $path) {
            if (! Storage::disk('public')->exists($path)) {
                Storage::disk('public')->put($path, 'test');
                $created[] = $path;
            }
        }

        try {
            $this->get(route('home'))
                ->assertOk()
                ->assertSee('data-hero-image="', false)
                ->assertSee('hero/slide1.webp', false)
                ->assertSee('hero/slide1-thumb.webp', false)
                ->assertDontSee('data-hero-image="https://akrightcity.com/en/images/slide1.jpeg"', false);
        } finally {
            foreach ($created as $path) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    public function test_sitemap_lists_public_and_dynamic_urls(): void
    {
        Village::factory()->create(['slug' => 'suncity']);
        NewsPost::factory()->create(['slug' => 'community-update', 'published_at' => now()]);

        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee(route('payments'), false)
            ->assertSee(route('villages.show', 'suncity'), false)
            ->assertSee(route('news.show', 'community-update'), false);
    }

    private function seedBaseContent(): void
    {
        PageContent::create([
            'key' => 'footer',
            'title' => 'Empowering our Community, one Story at a Time.',
            'body_html' => '<p>Akright City, Entebbe Road</p>',
            'data' => ['copyright' => '© 2025 Akright City Residents Association. All Rights Reserved.'],
        ]);

        PageContent::create([
            'key' => 'home',
            'title' => 'Welcome to Akright City',
            'subtitle' => 'Empowering our community, one story at a time.',
            'data' => [
                'slides' => [['title' => 'Welcome to Akright City', 'subtitle' => 'Community', 'cta' => 'Join']],
                'mission' => 'Our mission.',
                'vision' => 'Our vision.',
                'values' => ['Community First'],
                'quick_links' => [['label' => 'Frequently Asked Questions', 'route' => 'faqs']],
                'gallery' => ['title' => 'Gallery', 'subtitle' => 'Community Moments', 'image' => null],
            ],
        ]);

        PageContent::create([
            'key' => 'president',
            'title' => 'Message from the President',
            'subtitle' => 'Simon Kaggwa ACRA President - 2026',
            'body_html' => '<p>Welcome to Akright City.</p>',
        ]);
    }
}
