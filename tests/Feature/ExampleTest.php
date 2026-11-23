<?php

namespace Tests\Feature;

use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        PageContent::create(['key' => 'footer', 'title' => 'Footer']);
        PageContent::create(['key' => 'home', 'title' => 'Welcome to Akright City']);
        PageContent::create(['key' => 'president', 'title' => 'Message from the President']);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
