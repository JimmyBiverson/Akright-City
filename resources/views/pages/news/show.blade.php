@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt ?? $post->title)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => $post->published_at?->format('F j, Y'),
    'title' => $post->title,
    'subtitle' => $post->excerpt,
    'image' => $post->image,
    'backRoute' => route('news.index'),
    'backLabel' => 'All News',
])

<section class="container-site content-shell max-w-4xl">
    <div class="prose-content" data-reveal>{!! $post->body_html !!}</div>
    @if ($post->link)
        <a href="{{ $post->link }}" target="_blank" rel="noopener noreferrer" class="btn-secondary mt-6">{{ $post->link_label ?: 'View Original Story ↗' }}</a>
    @endif
</section>
@endsection
