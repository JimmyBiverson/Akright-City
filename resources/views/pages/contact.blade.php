@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Find Us',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell grid gap-10 lg:grid-cols-[1fr,2fr]">
    <div class="card feature-panel h-fit p-8" data-reveal>
        <p class="eyebrow">Find Us</p>
        <h2 class="section-title">{{ $page->title }}</h2>
        <div class="prose-content mt-6">{!! $page->body_html !!}</div>
    </div>

    <div>
        <div class="card p-8" data-reveal>
            <h2 class="text-2xl font-bold">Send us a message</h2>

            @if (session('status'))
                <div class="mt-4 rounded-xl border border-brand-200 bg-brand-50 p-4 text-brand-900">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="mt-6 grid gap-5">
                @csrf
                <div class="form-field">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" required autocomplete="name" value="{{ old('name') }}">
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}">
                </div>
                <div class="form-field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                </div>
                <div class="hidden" aria-hidden="true">
                    <label for="website">Leave this field empty</label>
                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                </div>
                <button type="submit" class="btn-primary justify-self-start">Send Message</button>
            </form>
        </div>

        @if ($page->data['map_url'] ?? null)
            <div class="card mt-6 overflow-hidden">
                <div class="relative aspect-[16/9] bg-slate-100" data-embed-target>
                    <button type="button" data-load-embed data-embed-src="{{ $page->data['map_url'] }}" data-embed-title="Akright City location map" class="absolute inset-0 flex flex-col items-center justify-center gap-2 text-brand-900" aria-label="Load Akright City location map">
                        <span class="text-4xl" aria-hidden="true">📍</span>
                        <span class="font-semibold">Load Akright City map</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
