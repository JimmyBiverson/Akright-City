<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/x-icon" sizes="any" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    <title>@hasSection('title') @yield('title') | @endif ACRA Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="min-h-screen lg:grid lg:grid-cols-[240px,1fr]">
        <aside class="border-b border-slate-200 bg-white p-5 lg:min-h-screen lg:border-b-0 lg:border-r">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-ink-900">
                <img src="{{ asset('acra-logo.png') }}" alt="ACRA Logo" class="h-9 w-9 rounded-full">
                ACRA Admin
            </a>
            <nav class="mt-6 grid gap-1 text-sm" aria-label="Admin navigation">
                <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Dashboard</a>
                <a href="{{ route('admin.messages.index') }}" class="rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Messages</a>
                <a href="{{ route('admin.media.index') }}" class="rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Media</a>
                <p class="mt-4 px-3 text-xs font-bold uppercase tracking-wider text-slate-400">Content</p>
                @foreach (config('admin.resources', []) as $key => $resource)
                    <a href="{{ route('admin.content.index', $key) }}" class="rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">{{ $resource['label'] }}</a>
                @endforeach
            </nav>
        </aside>

        <div class="min-w-0">
            <header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4">
                <h1 class="text-lg font-bold">@yield('heading', 'Admin')</h1>
                <div class="flex items-center gap-4 text-sm">
                    <span class="text-slate-500">{{ auth()->user()?->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-brand-700">Log out</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-brand-200 bg-brand-50 p-4 text-sm text-brand-900">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
