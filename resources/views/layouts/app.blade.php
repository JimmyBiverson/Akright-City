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
<body class="min-h-screen">
    <header class="site-header {{ request()->routeIs('home') ? '' : 'is-solid' }}" data-site-header>
        <div class="utility-bar">
            <div class="container-site utility-inner">
                <span>Akright City, Entebbe Road</span>
                <a href="mailto:info@akrightcity.com">info@akrightcity.com</a>
                <a href="{{ route('payments') }}">Pay ACRA Subscription</a>
            </div>
        </div>

        <div class="nav-bar">
            <div class="container-site nav-inner">
                <button type="button" data-mobile-open class="menu-button" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-navigation">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="brand-lockup" aria-label="Akright City home">
                    <span class="brand-plate">
                        <img src="{{ App\Support\LegacyAsset::url('images/logo.png') }}" alt="ACRA Logo">
                    </span>
                    <span class="brand-copy">
                        <strong>Akright City</strong>
                        <span>Residents Association</span>
                    </span>
                </a>

                <nav class="desktop-nav" aria-label="Main navigation">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-current' : '' }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'is-current' : '' }}">About Us</a>
                        </li>
                        <li data-dropdown data-open="false">
                            <button type="button" class="drop-trigger" data-dropdown-trigger aria-expanded="false">Team <span aria-hidden="true">⌄</span></button>
                            <ul class="mega-menu">
                                <li class="mega-title">Association Leadership</li>
                                <li><a href="{{ route('team') }}#executive">Executive Committee</a></li>
                                <li><a href="{{ route('team') }}#council">Council Members</a></li>
                                <li><a href="{{ route('team') }}#conciliatory">Conciliatory Committee</a></li>
                            </ul>
                        </li>
                        <li data-dropdown data-open="false">
                            <button type="button" class="drop-trigger" data-dropdown-trigger aria-expanded="false">Villages <span aria-hidden="true">⌄</span></button>
                            <ul class="mega-menu">
                                <li class="mega-title">Our Twelve Villages</li>
                                @foreach (App\Models\Village::orderBy('sort_order')->get() as $village)
                                    <li><a href="{{ route('villages.show', $village->slug) }}">{{ str_replace(' Village', '', $village->name) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('reports') }}" class="nav-link {{ request()->routeIs('reports') ? 'is-current' : '' }}">Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('directory') }}" class="nav-link {{ request()->routeIs('directory') ? 'is-current' : '' }}">Directory</a>
                        </li>
                        <li>
                            <a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.*') ? 'is-current' : '' }}">News</a>
                        </li>
                        <li data-dropdown data-open="false">
                            <button type="button" class="drop-trigger" data-dropdown-trigger aria-expanded="false">Watch &amp; Listen <span aria-hidden="true">⌄</span></button>
                            <ul class="mega-menu">
                                <li class="mega-title">Media Library</li>
                                <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                                <li><a href="{{ route('youtube') }}">Youtube Channel</a></li>
                            </ul>
                        </li>
                        <li data-dropdown data-open="false">
                            <button type="button" class="drop-trigger" data-dropdown-trigger aria-expanded="false">Help &amp; Info <span aria-hidden="true">⌄</span></button>
                            <ul class="mega-menu">
                                <li class="mega-title">Resident Support</li>
                                <li><a href="{{ route('faqs') }}">FAQS</a></li>
                                <li><a href="{{ route('contact') }}">Find Us</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <a href="{{ route('payments') }}" class="btn btn-gold header-cta">Payments</a>
            </div>
        </div>
    </header>

    <div class="mobile-nav-overlay" data-mobile-overlay aria-hidden="true"></div>

    <aside id="mobile-navigation" class="mobile-nav" data-mobile-nav aria-hidden="true" aria-label="Mobile navigation">
        <div class="mobile-nav-top">
            <span class="section-label">Navigation</span>
            <button type="button" data-mobile-close class="mobile-nav-close" aria-label="Close navigation">Close ×</button>
        </div>

        <ul class="mobile-nav-main">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li>
                <details>
                    <summary>Team <span aria-hidden="true">⌄</span></summary>
                    <div class="mobile-submenu">
                        <a href="{{ route('team') }}#executive">Executive Committee</a>
                        <a href="{{ route('team') }}#council">Council Members</a>
                        <a href="{{ route('team') }}#conciliatory">Conciliatory Committee</a>
                    </div>
                </details>
            </li>
            <li>
                <details>
                    <summary>Villages <span aria-hidden="true">⌄</span></summary>
                    <div class="mobile-submenu">
                        @foreach (App\Models\Village::orderBy('sort_order')->get() as $village)
                            <a href="{{ route('villages.show', $village->slug) }}">{{ str_replace(' Village', '', $village->name) }}</a>
                        @endforeach
                    </div>
                </details>
            </li>
            <li><a href="{{ route('reports') }}">Reports</a></li>
            <li><a href="{{ route('directory') }}">Directory</a></li>
            <li><a href="{{ route('news.index') }}">News</a></li>
            <li>
                <details>
                    <summary>Watch &amp; Listen <span aria-hidden="true">⌄</span></summary>
                    <div class="mobile-submenu">
                        <a href="{{ route('gallery') }}">Photo Gallery</a>
                        <a href="{{ route('youtube') }}">Youtube Channel</a>
                    </div>
                </details>
            </li>
            <li>
                <details>
                    <summary>Help &amp; Info <span aria-hidden="true">⌄</span></summary>
                    <div class="mobile-submenu">
                        <a href="{{ route('faqs') }}">FAQS</a>
                        <a href="{{ route('contact') }}">Find Us</a>
                    </div>
                </details>
            </li>
        </ul>

        <a href="{{ route('payments') }}" class="btn btn-gold header-cta">Payments</a>
    </aside>

    <main>
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
                    <li><a href="{{ route('directory') }}">Services</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('youtube') }}">Youtube Channel</a></li>
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
