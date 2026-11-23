@extends('layouts.app')

@section('title', $village->name)
@section('description', $village->tagline ?? $village->name)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => $village->tagline,
    'title' => $village->name,
    'subtitle' => 'Chairperson, '.$village->chairperson,
    'image' => $village->card_image,
    'backRoute' => route('villages.index'),
    'backLabel' => 'All Villages',
])

<section class="container-site content-shell">
    <div class="grid gap-6 lg:grid-cols-2">
        @if ($village->chairperson)
            <div class="card feature-panel p-8" data-reveal>
                <p class="eyebrow">Village Leadership</p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-100 text-xl font-bold text-brand-700">{{ substr($village->chairperson, 0, 1) }}</div>
                    <div>
                        <p class="text-lg font-bold">{{ $village->chairperson }}</p>
                        <p class="text-sm text-slate-600">Chairperson, {{ $village->name }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($village->chairperson_message)
            <div class="card bg-brand-50 p-8 prose-content" data-reveal>
                <h2>Message from the Chairperson</h2>
                {!! $village->chairperson_message !!}
            </div>
        @endif
    </div>

    <div class="prose-content feature-panel mt-10 max-w-none bg-white p-8" data-reveal>{!! $village->body_html !!}</div>

    @if ($village->map_image)
        <div class="mt-14" data-reveal>
            <p class="eyebrow">Location</p>
            <h2 class="section-title">Village Map</h2>
            @if (str_starts_with($village->map_image, 'http') || str_starts_with($village->map_image, '/storage/'))
                <img src="{{ $village->map_image }}" alt="{{ $village->name }} map" class="mt-5 max-h-96 rounded-2xl object-contain" loading="lazy">
            @else
                <p class="mt-4 rounded-xl bg-white p-6 text-slate-600">{{ $village->map_image }}</p>
            @endif
        </div>
    @endif

    @if (count($village->gallery_images ?? []) > 0)
        <div class="mt-14">
            <div data-reveal>
                <p class="eyebrow">Gallery</p>
                <h2 class="section-title">Life in {{ str_replace(' Village', '', $village->name) }}</h2>
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($village->gallery_images ?? [] as $image)
                    <img src="{{ $image }}" alt="Life in {{ $village->name }}" class="h-56 w-full rounded-2xl object-cover" loading="lazy" data-reveal>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
