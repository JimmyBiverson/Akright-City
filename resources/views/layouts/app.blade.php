<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Akright City Residents Association')">
    <title>@hasSection('title') @yield('title') | Akright City @else Akright City Residents Association @endif</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Akright City Residents Association')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen {{ request()->routeIs('home') ? 'home' : 'inner-page' }}">
    @php
        $navVillages = App\Models\Village::orderBy('sort_order')->get();
    @endphp

    <a class="skip-link" href="#main-content">Skip to content</a>

    <header class="site-header {{ request()->routeIs('home') ? '' : 'is-solid' }}" id="safari-header" data-site-header>
        <div class="header-top-bar">
            <div class="container-site top-bar-content">
                <div class="top-bar-left">
                    <span class="top-contact">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <span>Akright City, Entebbe Road</span>
                    </span>
                    <a href="mailto:info@akrightcity.com" class="top-contact">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" d="m4 7 8 6 8-6"/></svg>
                        <span>info@akrightcity.com</span>
                    </a>
                </div>
                <div class="top-bar-right">
                    <a href="{{ route('payments') }}">Pay ACRA Subscription</a>
                </div>
            </div>
        </div>

        <nav class="main-nav" id="main-nav" data-main-nav aria-label="Primary">
            <div class="container-site nav-wrapper">
                <button type="button" class="mobile-menu-btn" id="mobile-menu-btn" data-mobile-open aria-label="Toggle Menu" aria-controls="mobile-navigation" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>

                <ul class="nav-links nav-left" id="menu-header-left">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-current' : '' }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'is-current' : '' }}" @if(request()->routeIs('about')) aria-current="page" @endif>About Us</a></li>
                    <li class="has-dropdown" data-dropdown data-open="false">
                        <a href="{{ route('team') }}" class="nav-link {{ request()->routeIs('team') ? 'is-current' : '' }}" data-dropdown-trigger aria-expanded="false" aria-controls="menu-team" @if(request()->routeIs('team')) aria-current="page" @endif>
                            Team
                            <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                        </a>
                        <div class="mega-menu simple-menu" id="menu-team">
                            <div class="mega-menu-content">
                                <div class="mega-menu-section">
                                    <h4><a href="{{ route('team') }}">Association Leadership</a></h4>
                                    <ul>
                                        <li><a href="{{ route('team') }}#executive"><i aria-hidden="true"></i> Executive Committee</a></li>
                                        <li><a href="{{ route('team') }}#council"><i aria-hidden="true"></i> Council Members</a></li>
                                        <li><a href="{{ route('team') }}#conciliatory"><i aria-hidden="true"></i> Conciliatory Committee</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-section">
                                    <h4>Get Involved</h4>
                                    <ul>
                                        <li><a href="{{ route('contact') }}"><i aria-hidden="true"></i> Contact the Association</a></li>
                                        <li><a href="{{ route('payments') }}" class="mega-all"><i aria-hidden="true"></i> Pay ACRA Subscription</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="has-dropdown" data-dropdown data-open="false">
                        <a href="{{ route('villages.index') }}" class="nav-link {{ request()->routeIs('villages.*') ? 'is-current' : '' }}" data-dropdown-trigger aria-expanded="false" aria-controls="menu-villages" @if(request()->routeIs('villages.*')) aria-current="page" @endif>
                            Villages
                            <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                        </a>
                        <div class="mega-menu" id="menu-villages">
                            <div class="mega-menu-content">
                                <div class="mega-menu-section">
                                    <h4><a href="{{ route('villages.index') }}">Our Twelve Villages</a></h4>
                                    <ul>
                                        <li><a href="{{ route('villages.index') }}" class="mega-all"><i aria-hidden="true"></i> All Villages</a></li>
                                    </ul>
                                </div>
                                @foreach ($navVillages->chunk(4) as $chunk)
                                    <div class="mega-menu-section">
                                        <h4>Community</h4>
                                        <ul>
                                            @foreach ($chunk as $village)
                                                <li><a href="{{ route('villages.show', $village->slug) }}"><i aria-hidden="true"></i> {{ str_replace(' Village', '', $village->name) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>

                <a href="{{ route('home') }}" class="nav-logo" aria-label="Akright City home">
                    <span class="brand-logo brand-logo--nav">
                        <img src="{{ App\Support\LegacyAsset::url('images/logo.png') }}" alt="ACRA Logo">
                    </span>
                </a>

                <ul class="nav-links nav-right" id="menu-header-right">
                    <li><a href="{{ route('reports') }}" class="nav-link {{ request()->routeIs('reports') ? 'is-current' : '' }}" @if(request()->routeIs('reports')) aria-current="page" @endif>Reports</a></li>
                    <li><a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.*') ? 'is-current' : '' }}" @if(request()->routeIs('news.*')) aria-current="page" @endif>News</a></li>
                    <li class="has-dropdown" data-dropdown data-open="false">
                        <a href="{{ route('faqs') }}" class="nav-link {{ request()->routeIs('faqs', 'gallery', 'youtube', 'contact', 'directory') ? 'is-current' : '' }}" data-dropdown-trigger aria-expanded="false" aria-controls="menu-help">
                            Help &amp; Info
                            <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                        </a>
                        <div class="mega-menu narrow" id="menu-help">
                            <div class="mega-menu-content">
                                <div class="mega-menu-section">
                                    <h4>Community</h4>
                                    <ul>
                                        <li><a href="{{ route('directory') }}"><i aria-hidden="true"></i> Community Directory</a></li>
                                        <li><a href="{{ route('contact') }}"><i aria-hidden="true"></i> Find Us</a></li>
                                        <li><a href="{{ route('faqs') }}" class="mega-all"><i aria-hidden="true"></i> FAQs</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-section">
                                    <h4>Watch &amp; Listen</h4>
                                    <ul>
                                        <li><a href="{{ route('gallery') }}"><i aria-hidden="true"></i> Photo Gallery</a></li>
                                        <li><a href="{{ route('youtube') }}"><i aria-hidden="true"></i> YouTube Channel</a></li>
                                        <li><a href="{{ route('reports') }}" class="mega-all"><i aria-hidden="true"></i> Reports &amp; Documents</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <a href="{{ route('payments') }}" class="cta-button">Payments</a>
            </div>
        </nav>
    </header>

    <div class="mobile-nav-overlay" id="mobile-nav-overlay" data-mobile-overlay aria-hidden="true"></div>

    <aside id="mobile-navigation" class="mobile-nav" data-mobile-nav data-lenis-prevent aria-hidden="true" aria-modal="true" role="dialog" aria-label="Mobile navigation">
        <div class="mobile-nav-header">
            <a href="{{ route('home') }}" class="mobile-nav-logo" aria-label="Akright City home">
                <span class="brand-logo brand-logo--mobile">
                    <img src="{{ App\Support\LegacyAsset::url('images/logo.png') }}" alt="ACRA Logo">
                </span>
            </a>
            <button type="button" class="mobile-close-btn" id="mobile-close-btn" data-mobile-close aria-label="Close Menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>

        <ul class="mobile-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li>
                <button type="button" class="mobile-submenu-toggle" data-mobile-submenu-toggle aria-expanded="false" aria-controls="mobile-menu-team">
                    Team
                    <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                </button>
                <ul class="mobile-submenu" id="mobile-menu-team">
                    <li><a href="{{ route('team') }}">All Leadership</a></li>
                    <li class="mobile-subhead"><span>Association</span></li>
                    <li><a href="{{ route('team') }}#executive">Executive Committee</a></li>
                    <li><a href="{{ route('team') }}#council">Council Members</a></li>
                    <li><a href="{{ route('team') }}#conciliatory">Conciliatory Committee</a></li>
                </ul>
            </li>
            <li>
                <button type="button" class="mobile-submenu-toggle" data-mobile-submenu-toggle aria-expanded="false" aria-controls="mobile-menu-villages">
                    Villages
                    <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                </button>
                <ul class="mobile-submenu" id="mobile-menu-villages">
                    <li><a href="{{ route('villages.index') }}">All Villages</a></li>
                    @foreach ($navVillages as $village)
                        <li><a href="{{ route('villages.show', $village->slug) }}">{{ str_replace(' Village', '', $village->name) }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('reports') }}">Reports &amp; Documents</a></li>
            <li><a href="{{ route('news.index') }}">News</a></li>
            <li>
                <button type="button" class="mobile-submenu-toggle" data-mobile-submenu-toggle aria-expanded="false" aria-controls="mobile-menu-help">
                    Help &amp; Info
                    <svg class="nav-chevron" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="m1 1 5 5 5-5"/></svg>
                </button>
                <ul class="mobile-submenu" id="mobile-menu-help">
                    <li><a href="{{ route('directory') }}">Community Directory</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                    <li><a href="{{ route('youtube') }}">YouTube Channel</a></li>
                    <li><a href="{{ route('contact') }}">Find Us</a></li>
                </ul>
            </li>
            <li class="mobile-cta"><a href="{{ route('payments') }}" class="cta-button">Payments</a></li>
        </ul>
    </aside>

    <main id="main-content">
        @yield('content')
    </main>

    <section class="dark-band py-20">
        <canvas class="particle-canvas" data-particles aria-hidden="true"></canvas>
        <div class="container-site relative z-[2] grid items-center gap-8 md:grid-cols-[2fr,1fr]">
            <div>
                <p class="section-label eyebrow-light">Akright City Residents Association</p>
                <h2 class="mt-3">{{ $footerContent?->title ?? 'Empowering our Community, one Story at a Time.' }}</h2>
                <div class="prose-content mt-4">{!! $footerContent?->body_html !!}</div>
            </div>
            <a href="{{ route('payments') }}" class="btn btn-gold inline-flex justify-center">Pay ACRA Subscription</a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container-site footer-top">
            <div class="footer-brand">
                <span class="brand-plate">
                    <img src="{{ App\Support\LegacyAsset::url('images/logo.png') }}" alt="ACRA Logo" loading="lazy">
                </span>
                <div>
                    <strong>Akright City Residents Association</strong>
                    <p>Akright City, Entebbe Road<br>info@akrightcity.com</p>
                    <img src="{{ App\Support\LegacyAsset::url('images/social.png') }}" alt="Social Media" class="mt-4 h-8" loading="lazy">
                </div>
            </div>
            <div>
                <h2>Explore</h2>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('directory') }}">Community Directory</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('youtube') }}">YouTube Channel</a></li>
                </ul>
            </div>
            <div>
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="{{ route('reports') }}">Reports</a></li>
                    <li><a href="{{ route('directory') }}">Directory</a></li>
                    <li><a href="{{ route('news.index') }}">News</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                </ul>
            </div>
            <div>
                <h2>Contact</h2>
                <ul>
                    <li><a href="{{ route('contact') }}">Find Us</a></li>
                    <li><a href="mailto:info@akrightcity.com">info@akrightcity.com</a></li>
                    <li><a href="{{ route('payments') }}">Payments</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            {{ $footerContent?->data['copyright'] ?? '© 2025 Akright City Residents Association. All Rights Reserved.' }}
        </div>
    </footer>
</body>
</html>
