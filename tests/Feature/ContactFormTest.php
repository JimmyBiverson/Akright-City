<?php

namespace Tests\Feature;

use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_form(): void
    {
        $this->seedContactPage();

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Send us a message')
            ->assertSee('name="email"', false)
            ->assertSee('name="message"', false);
    }

    public function test_store_creates_contact_message(): void
    {
        $this->seedContactPage();

        $this->post(route('contact.store'), [
            'name' => 'Jimmy Bamugemye',
            'email' => 'jimmy@example.com',
            'subject' => 'Website enquiry',
            'message' => 'Please contact me about the website.',
        ])->assertRedirect();

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jimmy Bamugemye',
            'email' => 'jimmy@example.com',
            'subject' => 'Website enquiry',
        ]);
    }

    public function test_store_rejects_invalid_submission(): void
    {
        $this->seedContactPage();

        $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ])->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_store_rejects_honeypot_submission(): void
    {
        $this->seedContactPage();

        $this->post(route('contact.store'), [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'message' => 'Spam message',
            'website' => 'https://spam.example.com',
        ])->assertSessionHasErrors('website');

        $this->assertDatabaseCount('contact_messages', 0);
    }

    private function seedContactPage(): void
    {
        PageContent::create([
            'key' => 'footer',
            'title' => 'Footer',
            'body_html' => '<p>Akright City, Entebbe Road</p>',
        ]);

        PageContent::create([
            'key' => 'contact',
            'title' => 'Get in Touch',
            'subtitle' => "We'd love to hear from you.",
            'body_html' => '<p>Contact Information</p>',
        ]);
    }
}
