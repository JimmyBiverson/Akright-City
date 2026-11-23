@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'News',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <article class="card overflow-hidden" data-reveal>
                @if ($post->image)
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="h-52 w-full object-cover">
                @endif
                <div class="p-6">
                    <p class="news-date">{{ $post->published_at?->format('F j, Y') }}</p>
                    <h2 class="mt-2 text-xl font-bold">{{ $post->title }}</h2>
                    <p class="mt-3 text-sm text-slate-600">{{ $post->excerpt }}</p>
                    <a href="{{ $post->link ?: route('news.show', $post->slug) }}" @if (str_starts_with($post->link ?? '', 'http')) target="_blank" rel="noopener noreferrer" @endif class="read-more-link">{{ $post->link_label ?: 'Read More →' }}</a>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
