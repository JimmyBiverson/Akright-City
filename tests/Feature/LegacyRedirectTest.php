<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LegacyRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_php_redirects_to_home(): void
    {
        $this->get('/index.php')->assertRedirect(route('home'));
    }

    public function test_village_php_redirects_to_village_page(): void
    {
        $this->get('/village_green_terrace.php')
            ->assertRedirect(route('villages.show', 'green-terrace'));
    }

    public function test_news_details_php_redirects_known_article(): void
    {
        $this->get('/news_details.php?id=4')
            ->assertRedirect(route('news.show', 'international-womens-day'));
    }

    public function test_unknown_legacy_page_redirects_to_home(): void
    {
        $this->get('/unknown_page.php')->assertRedirect(route('home'));
    }
}
