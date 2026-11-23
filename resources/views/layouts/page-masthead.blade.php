@php
    $eyebrow = $eyebrow ?? 'Akright City';
    $title = $title ?? '';
    $subtitle = $subtitle ?? null;
    $image = $image ?? App\Support\LegacyAsset::url('images/slide1.jpeg');
    $backRoute = $backRoute ?? null;
    $backLabel = $backLabel ?? 'Back';
@endphp

<section class="page-hero">
    <div class="page-hero-media" style="background-image: url('{{ $image }}');"></div>
    <div class="page-hero-scrim"></div>
    <div class="container-site page-hero-inner">
        @if ($backRoute)
            <a href="{{ $backRoute }}" class="page-hero-back">← {{ $backLabel }}</a>
        @endif
        <p class="eyebrow eyebrow-light">{{ $eyebrow }}</p>
        <h1>{{ $title }}</h1>
        @if ($subtitle)
            <p class="page-hero-sub">{{ $subtitle }}</p>
        @endif
    </div>
</section>
