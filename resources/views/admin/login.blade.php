<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login | Akright City</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-100 p-6">
    <div class="card w-full max-w-md p-8">
        <img src="{{ App\Support\LegacyAsset::url('images/logo.png') }}" alt="ACRA Logo" class="mx-auto h-14 w-14 rounded-full">
        <h1 class="mt-5 text-center text-2xl font-bold">ACRA Admin</h1>
        <p class="mt-1 text-center text-sm text-slate-500">Sign in to manage community content.</p>

        @if ($errors->any())
            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 grid gap-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold">Email</label>
                <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="mt-2 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                Remember me
            </label>
            <button type="submit" class="btn-primary w-full">Sign in</button>
        </form>
    </div>
</body>
</html>
