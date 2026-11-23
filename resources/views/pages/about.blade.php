@extends('layouts.app')

@section('title', 'About Us')
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'About ACRA',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
    'image' => $page->hero_image,
])

<section class="container-site content-shell">
    <div class="prose-content max-w-4xl" data-reveal>{!! $page->body_html !!}</div>
</section>

<section class="bg-white content-shell">
    <div class="container-site grid gap-8 lg:grid-cols-[1fr,2fr]">
        <div data-reveal>
            <p class="eyebrow">President</p>
            <h2 class="section-title">Message from the President</h2>
            <p class="mt-4 font-bold">{{ $page->data['president_name'] ?? '' }}</p>
            <p class="text-slate-600">{{ $page->data['president_role'] ?? '' }}</p>
        </div>
        <div class="card feature-panel p-8 prose-content" data-reveal>{!! $page->data['president_message'] ?? '' !!}</div>
    </div>
</section>

<section class="container-site content-shell">
    <div data-reveal>
        <p class="eyebrow">Looking Ahead</p>
        <h2 class="section-title">{{ $page->data['vision_title'] ?? '' }}</h2>
        <p class="section-sub">{{ $page->data['vision_subtitle'] ?? '' }}</p>
    </div>
    <div class="mt-8 grid gap-6 md:grid-cols-2">
        @foreach ($page->data['vision_videos'] ?? [] as $videoId)
            <div class="relative aspect-video overflow-hidden rounded-2xl bg-ink-900 shadow-sm" data-embed-target data-reveal>
                <button type="button" data-load-embed data-embed-src="https://www.youtube-nocookie.com/embed/{{ $videoId }}" data-embed-title="{{ $page->data['vision_title'] ?? 'President Vision' }}" class="absolute inset-0 flex items-center justify-center text-white" aria-label="Play {{ $page->data['vision_title'] ?? 'President Vision' }}">
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-600 text-2xl shadow-lg" aria-hidden="true">▶</span>
                </button>
            </div>
        @endforeach
    </div>
</section>
@endsection
