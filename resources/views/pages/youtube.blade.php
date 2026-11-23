@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Watch & Listen',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell">
    <a href="{{ $page->data['channel_url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary" data-reveal>{{ $page->data['channel_label'] ?? 'Visit Our Youtube Channel' }} ↗</a>

    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($videos as $video)
            @php
                $embedUrl = $video->video_id
                    ? 'https://www.youtube-nocookie.com/embed/'.$video->video_id
                    : ($video->url ?? ($page->data['channel_url'] ?? '#'));
            @endphp
            <article class="card overflow-hidden" data-reveal>
                <div class="relative aspect-video bg-ink-900" data-embed-target>
                    <button type="button" data-load-embed data-embed-src="{{ $embedUrl }}" data-embed-title="{{ $video->title }}" class="absolute inset-0 flex items-center justify-center text-white" aria-label="Play {{ $video->title }}">
                        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-600 text-2xl shadow-lg transition group-hover:scale-110" aria-hidden="true">▶</span>
                    </button>
                </div>
                <div class="p-6">
                    <h2 class="font-bold text-brand-900">{{ $video->title }}</h2>
                    <a href="{{ $video->url ?: ($page->data['channel_url'] ?? '#') }}" target="_blank" rel="noopener noreferrer" class="read-more-link">Watch on Youtube ↗</a>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
