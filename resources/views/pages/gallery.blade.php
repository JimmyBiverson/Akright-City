@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@php
    $allYears = $years->merge(array_keys($page->data['empty_years'] ?? []))->unique()->sortDesc()->values();
@endphp

@include('layouts.page-masthead', [
    'eyebrow' => 'Watch & Listen',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell" data-tabs>
    <div class="flex flex-wrap gap-3" role="tablist" aria-label="Gallery years" data-reveal>
        @foreach ($allYears as $year)
            <button type="button" class="tab-button {{ $loop->first ? 'is-active' : '' }}" data-tab-button="{{ $year }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $year }}</button>
        @endforeach
    </div>

    @foreach ($allYears as $year)
        @php($yearImages = $images->where('year', $year))
        <div class="mt-10 {{ $loop->first ? '' : 'hidden' }}" data-tab-panel="{{ $year }}">
            @if ($yearImages->isEmpty())
                <p class="mt-4 rounded-2xl bg-white p-8 text-slate-600">{{ $page->data['empty_years'][(string) $year] ?? 'No photos uploaded for this year yet.' }}</p>
            @else
                @foreach ($yearImages->groupBy('category') as $category => $items)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-brand-900">{{ $category }}</h2>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($items as $image)
                                <button type="button" data-gallery-image="{{ $image->display_path ?? $image->path }}" data-gallery-alt="{{ $image->alt_text ?: ($image->title ?: $category) }}" class="group overflow-hidden rounded-2xl bg-white text-left shadow-sm" aria-label="View {{ $image->title ?: $category }} image" data-reveal>
                                    <img src="{{ $image->display_path ?? $image->path }}" alt="{{ $image->alt_text ?: ($image->title ?: $category) }}" loading="lazy" decoding="async" class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</section>

<div data-lightbox class="hidden fixed inset-0 z-50 flex items-center justify-center bg-ink-900/90 p-6" role="dialog" aria-modal="true" aria-label="Image viewer">
    <button type="button" data-lightbox-close class="absolute right-6 top-6 rounded-full bg-white/10 px-4 py-2 text-white" aria-label="Close image viewer">Close ✕</button>
    <img data-lightbox-image src="" alt="Selected gallery image" class="max-h-[90vh] max-w-full rounded-xl">
</div>
@endsection
