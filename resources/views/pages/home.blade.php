@extends('layouts.app')

@section('title', 'Home')
@section('description', $home->meta_description ?? 'Akright City Residents Association')

@section('content')
@php
    $sliderVillages = $villages->take(10);
    $ctaRoutes = ['Learn More' => route('about'), 'Contact Us' => route('contact')];
@endphp

<section class="hero-slider" data-hero>
    <canvas class="particle-canvas" data-particles aria-hidden="true"></canvas>

    @foreach ($slides as $index => $slide)
        <div class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-hero-slide data-hero-image="{{ $slide['image'] }}">
            <div class="hero-bg" style="background-image: url('{{ $slide['image'] ?? '' }}');"></div>
            <div class="hero-scrim"></div>
            <div class="container-site hero-content">
                <div class="hero-copy">
                    <p class="hero-tag">Akright City Residents Association</p>
                    <h1>{{ $slide['title'] }}</h1>
                    <p>{{ $slide['subtitle'] }}</p>
                    <a href="{{ $ctaRoutes[$slide['cta']] ?? route('contact') }}" class="hero-cta">{{ $slide['cta'] }}</a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="hero-side">
        <div class="hero-thumbs" role="tablist" aria-label="Hero slides">
            @foreach ($slides as $index => $slide)
                <button type="button" class="hero-thumb {{ $index === 0 ? 'is-active' : '' }}" data-hero-thumb role="tab" aria-label="Go to slide {{ $index + 1 }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                    <span class="hero-thumb-ring" data-hero-thumb-ring>
                        <img src="{{ $slide['thumbnail'] ?? $slide['image'] }}" alt="" loading="lazy">
                    </span>
                    <span>{{ $slide['cta'] }}</span>
                </button>
            @endforeach
        </div>
        <button type="button" class="hero-arrow" data-hero-previous aria-label="Previous slide">←</button>
        <button type="button" class="hero-arrow" data-hero-next aria-label="Next slide">→</button>
    </div>

    <div class="hero-progress"><div class="hero-progress-bar" data-hero-progress></div></div>
    <img class="hero-expand" data-hero-expand alt="" aria-hidden="true">
</section>

<section class="intro-band">
    <div class="container-site intro-inner" data-reveal>
        <h2>{{ $president->title }}</h2>
        <p>{{ $home->data['mission'] ?? '' }}</p>
    </div>
</section>

<section class="mosaic reveal">
    <div class="mosaic-grid">
        <article class="mosaic-card president-card card-left">
            <div class="president-header">
                <img src="{{ $president->hero_image }}" alt="Simon Kaggwa - ACRA President" loading="lazy">
            </div>
            <div class="president-body">
                <h3>{{ $president->title }}</h3>
                <p class="intro">{{ $president->data['intro'] ?? '' }}</p>
                <p>{{ $president->data['body'] ?? strip_tags($president->body_html ?? '') }}</p>
                <div class="signature">
                    <strong>{{ $president->data['signature_name'] ?? 'Simon Kaggwa' }}</strong>
                    <span>{{ $president->data['signature_role'] ?? 'ACRA President - 2026' }}</span>
                </div>
                <a href="{{ route('about') }}" class="read-more">Read Full Message →</a>
            </div>
        </article>

        <article class="mosaic-card mission-card card-top-right">
            <div class="mission-content">
                <div class="mission-item">
                    <h4>Our Mission</h4>
                    <p>{{ $home->data['mission'] ?? '' }}</p>
                </div>
                <div class="mission-item">
                    <h4>Our Vision</h4>
                    <p>{{ $home->data['vision'] ?? '' }}</p>
                </div>
                <div class="mission-item">
                    <h4>Our Values</h4>
                    <ul>
                        @foreach ($home->data['values'] ?? [] as $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>

        <a href="{{ route('gallery') }}" class="mosaic-card gallery-card card-bottom-right">
            <img src="{{ $galleryImage }}" alt="Community gallery" loading="lazy">
            <div class="gallery-overlay">
                <h3>{{ $home->data['gallery']['title'] ?? 'Gallery' }}</h3>
                <p>{{ $home->data['gallery']['subtitle'] ?? 'Community Moments' }}</p>
            </div>
        </a>

        <nav class="mosaic-card quick-links" aria-label="Quick links">
            <h3>Quick Links</h3>
            <ul>
                @foreach ($home->data['quick_links'] ?? [] as $link)
                    <li><a href="{{ route($link['route']) }}">{{ $link['label'] }} <span aria-hidden="true">→</span></a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</section>

<section class="villages" id="villages">
    <div class="container-site section-center" data-reveal>
        <p class="section-label">Our Community</p>
        <h2 class="section-title">ACRA Villages</h2>
        <div class="section-divider"></div>
    </div>
    <div class="marquee">
        <div class="marquee-track villages-track" data-marquee>
            @foreach ([1, 2] as $set)
                @foreach ($sliderVillages as $village)
                    <a href="{{ route('villages.show', $village->slug) }}" class="village-card" @if ($set === 2) aria-hidden="true" tabindex="-1" @endif>
                        @if ($village->card_image)
                            <img src="{{ $village->card_image }}" alt="{{ str_replace(' Village', '', $village->name) }}" loading="lazy">
                        @endif
                        <h4>{{ str_replace(' Village', '', $village->name) }}</h4>
                        <p>Explore {{ str_replace(' Village', '', $village->name) }}</p>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

<section class="latest-news container-site">
    <div data-reveal>
        <p class="section-label">News</p>
        <h2 class="section-title">Latest News</h2>
        <div class="section-divider"></div>
    </div>
    <div class="news-grid">
        @foreach ($news as $post)
            @php
                $postUrl = $post->link ?: route('news.show', $post->slug);
                $isExternal = str_starts_with($post->link ?? '', 'http');
            @endphp
            <article class="news-card reveal delay-{{ $loop->index }}" data-reveal>
                <div class="news-image">
                    <a href="{{ $postUrl }}" @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                        @if ($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy">
                        @endif
                    </a>
                </div>
                <div class="news-content">
                    <span class="news-date">{{ $post->published_at?->format('F j, Y') }}</span>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                    <a href="{{ $postUrl }}" class="read-more-link" @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $post->link_label ?: 'Read More →' }}</a>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="leadership">
    <div class="container-site section-center" data-reveal>
        <p class="section-label">Leadership</p>
        <h2 class="section-title">ACRA Leadership</h2>
        <div class="section-divider"></div>
    </div>
    <div class="marquee">
        <div class="marquee-track leadership-track" data-marquee>
            @foreach ([1, 2] as $set)
                @foreach ($leadership as $member)
                    <div class="leadership-card" @if ($set === 2) aria-hidden="true" @endif>
                        @if ($member->photo && $member->photo !== 'Photo')
                            <div class="leadership-photo" style="background-image: url('{{ $member->photo }}');"></div>
                        @else
                            <div class="leadership-photo">Photo</div>
                        @endif
                        <div class="leadership-info">
                            <h4>{{ $member->name }}</h4>
                            <p>{{ $member->role }}</p>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

<section class="cta-zoom" data-cta-zoom>
    <div class="cta-zoom-media" data-cta-zoom-media style="background-image: url('{{ $galleryImage }}');"></div>
    <div class="cta-zoom-ring" data-cta-zoom-ring aria-hidden="true"></div>
    <div class="container-site cta-zoom-text" data-cta-zoom-text>
        <div>
            <p class="section-label eyebrow-light">Akright City Residents Association</p>
            <h2>{{ $footerContent?->title ?? 'Empowering our Community, one Story at a Time.' }}</h2>
            <div class="prose-content">{!! $footerContent?->body_html !!}</div>
            <a href="{{ route('contact') }}" class="btn btn-gold">Contact Us</a>
        </div>
    </div>
</section>

<section class="partners">
    <div class="container-site partners-container">
        <div class="partners-label">
            <h2>Our Partners</h2>
        </div>
        <div class="partners-scroll-wrapper">
            <div class="partners-track" data-marquee>
                @foreach ([1, 2] as $set)
                    @foreach ($partners as $partner)
                        <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" loading="lazy" @if ($set === 2) aria-hidden="true" @endif>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
