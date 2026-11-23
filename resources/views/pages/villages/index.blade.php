@extends('layouts.app')

@section('title', 'Villages')
@section('description', 'Explore the twelve villages of Akright City.')

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Our Community',
    'title' => 'ACRA Villages',
    'subtitle' => 'Explore the twelve villages of Akright City.',
])

<section class="container-site content-shell">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($villages as $village)
            <a href="{{ route('villages.show', $village->slug) }}" class="card group overflow-hidden hover:shadow-lg" data-reveal>
                @if ($village->card_image)
                    <img src="{{ $village->card_image }}" alt="{{ $village->name }}" class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                @endif
                <div class="p-5">
                    <h2 class="text-lg font-bold">{{ $village->name }}</h2>
                    <p class="mt-1 text-sm text-slate-600">{{ $village->tagline }}</p>
                    <p class="mt-3 text-sm font-semibold text-brand-700">Explore {{ str_replace(' Village', '', $village->name) }} →</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
