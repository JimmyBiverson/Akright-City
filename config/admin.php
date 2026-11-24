<?php

use App\Models\DirectoryEntry;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\NewsPost;
use App\Models\PageContent;
use App\Models\Partner;
use App\Models\Report;
use App\Models\TeamMember;
use App\Models\Video;
use App\Models\Village;

return [
    'email' => env('ADMIN_EMAIL', 'admin@akrightcity.com'),
    'name' => env('ADMIN_NAME', 'ACRA Administrator'),
    'password' => env('ADMIN_PASSWORD'),

    'resources' => [
        'pages' => [
            'label' => 'Page Content',
            'model' => PageContent::class,
            'identifier' => 'key',
            'order' => 'key',
            'fields' => [
                'key' => ['label' => 'Key', 'type' => 'text', 'rules' => ['required', 'string', 'max:100', 'unique:page_contents,key,{id}']],
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'subtitle' => ['label' => 'Subtitle', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'hero_image' => ['label' => 'Hero Image', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'data' => ['label' => 'Structured Data (JSON)', 'type' => 'json', 'rules' => ['nullable', 'string']],
                'body_html' => ['label' => 'Body HTML', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:500']],
            ],
        ],
        'villages' => [
            'label' => 'Villages',
            'model' => Village::class,
            'identifier' => 'slug',
            'order' => 'sort_order',
            'fields' => [
                'slug' => ['label' => 'Slug', 'type' => 'text', 'rules' => ['required', 'string', 'max:100', 'unique:villages,slug,{id}']],
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'tagline' => ['label' => 'Tagline', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'chairperson' => ['label' => 'Chairperson', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'chairperson_message' => ['label' => 'Chairperson Message (HTML)', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'body_html' => ['label' => 'Body HTML', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'map_image' => ['label' => 'Map Image', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'card_image' => ['label' => 'Card Image', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'gallery_images' => ['label' => 'Gallery Images (JSON)', 'type' => 'json', 'rules' => ['nullable', 'string']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'team' => [
            'label' => 'Team',
            'model' => TeamMember::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'group' => ['label' => 'Group', 'type' => 'text', 'rules' => ['required', 'string', 'max:100']],
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'role' => ['label' => 'Role', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'location' => ['label' => 'Location', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'photo' => ['label' => 'Photo', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'directory' => [
            'label' => 'Directory',
            'model' => DirectoryEntry::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'category' => ['label' => 'Category', 'type' => 'text', 'rules' => ['required', 'string', 'max:100']],
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'address' => ['label' => 'Address', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'phone' => ['label' => 'Phone', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'email' => ['label' => 'Email', 'type' => 'text', 'rules' => ['nullable', 'email', 'max:255']],
                'website' => ['label' => 'Website', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'details' => ['label' => 'Details', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'news' => [
            'label' => 'News',
            'model' => NewsPost::class,
            'identifier' => 'slug',
            'order' => 'sort_order',
            'fields' => [
                'slug' => ['label' => 'Slug', 'type' => 'text', 'rules' => ['required', 'string', 'max:100', 'unique:news_posts,slug,{id}']],
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'published_at' => ['label' => 'Published At', 'type' => 'date', 'rules' => ['required', 'date']],
                'image' => ['label' => 'Image', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'excerpt' => ['label' => 'Excerpt', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'body_html' => ['label' => 'Body HTML', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
                'link' => ['label' => 'Link', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'link_label' => ['label' => 'Link Label', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:100']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'reports' => [
            'label' => 'Reports',
            'model' => Report::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'year' => ['label' => 'Year', 'type' => 'number', 'rules' => ['required', 'integer', 'min:2000', 'max:2100']],
                'category' => ['label' => 'Category', 'type' => 'text', 'rules' => ['required', 'string', 'max:100']],
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'path' => ['label' => 'File URL', 'type' => 'url', 'rules' => ['nullable', 'string', 'max:2048']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'gallery' => [
            'label' => 'Gallery',
            'model' => GalleryImage::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'year' => ['label' => 'Year', 'type' => 'number', 'rules' => ['required', 'integer', 'min:2000', 'max:2100']],
                'category' => ['label' => 'Category', 'type' => 'text', 'rules' => ['required', 'string', 'max:100']],
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'path' => ['label' => 'Image URL', 'type' => 'url', 'rules' => ['required', 'string', 'max:2048']],
                'alt_text' => ['label' => 'Alt Text', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'videos' => [
            'label' => 'Videos',
            'model' => Video::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'video_id' => ['label' => 'YouTube Video ID', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:20']],
                'url' => ['label' => 'YouTube URL', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'faqs' => [
            'label' => 'FAQs',
            'model' => Faq::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'question' => ['label' => 'Question', 'type' => 'textarea', 'rules' => ['required', 'string']],
                'answer' => ['label' => 'Answer', 'type' => 'textarea', 'rules' => ['required', 'string']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
        'partners' => [
            'label' => 'Partners',
            'model' => Partner::class,
            'identifier' => 'id',
            'order' => 'sort_order',
            'fields' => [
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'logo' => ['label' => 'Logo URL', 'type' => 'url', 'rules' => ['required', 'string', 'max:2048']],
                'sort_order' => ['label' => 'Sort Order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0']],
            ],
        ],
    ],
];
