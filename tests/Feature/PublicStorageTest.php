<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicStorageTest extends TestCase
{
    public function test_public_storage_assets_are_available_without_a_symlink(): void
    {
        $this->assertDirectoryExists(public_path('storage'));
        $this->assertSame(realpath(public_path('storage')), realpath(Storage::disk('public')->path('')));
        $this->assertFileExists(public_path('storage/legacy/images/gallery.jpg'));
        $this->assertFileExists(public_path('storage/hero/slide1.webp'));
        $this->assertTrue(Storage::disk('public')->exists('legacy/images/gallery.jpg'));
        $this->assertTrue(Storage::disk('public')->exists('hero/slide1.webp'));
        $this->assertStringEndsWith('/storage/legacy/images/gallery.jpg', Storage::url('legacy/images/gallery.jpg'));
    }
}
