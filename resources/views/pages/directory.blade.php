@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@php
    $icons = [
        'Schools' => '🎓',
        'Restaurants & Bars' => '🍽️',
        'Churches / Mosque' => '🕌',
        'Services & Retail' => '🏬',
        'Utilities' => '⚙️',
        'Sports & Recreation' => '⚽',
    ];
@endphp

@include('layouts.page-masthead', [
    'eyebrow' => 'Community',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell">
    @foreach ($entries as $category => $items)
        <div class="mt-14 first:mt-0">
            <div data-reveal>
                <h2 class="flex items-center gap-3 text-3xl font-semibold"><span aria-hidden="true">{{ $icons[$category] ?? '•' }}</span>{{ $category }}</h2>
                <div class="section-divider"></div>
            </div>
            <div class="mt-6 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $entry)
                    <div class="card p-6" data-reveal>
                        <h3 class="text-lg font-bold text-brand-900">{{ $entry->name }}</h3>
                        @if ($entry->address)
                            <p class="mt-2 whitespace-pre-line text-sm text-slate-600">{{ $entry->address }}</p>
                        @endif
                        @if ($entry->details)
                            <p class="mt-2 text-sm text-slate-600">{{ $entry->details }}</p>
                        @endif
                        @if ($entry->phone)
                            <p class="mt-2 text-sm text-slate-600"><span class="font-semibold">Tel:</span> {{ $entry->phone }}</p>
                        @endif
                        @if ($entry->email)
                            <p class="mt-1 text-sm text-slate-600"><span class="font-semibold">Email:</span> {{ $entry->email }}</p>
                        @endif
                        @if ($entry->website)
                            <a href="{{ $entry->website }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-block text-sm font-semibold text-brand-700">Visit Website ↗</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
@endsection
