@extends('layouts.app')

@section('title', 'Our Team')
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@php
    $headings = ['executive' => 'Executive Committee', 'council' => 'Council Members', 'conciliatory' => 'Conciliatory Committee'];
    $descriptions = [
        'executive' => 'Our dedicated executive team leading the association.',
        'council' => 'Village Chairpersons forming the Council.',
        'conciliatory' => 'Ensuring harmony and conflict resolution.',
    ];
@endphp

@include('layouts.page-masthead', [
    'eyebrow' => 'Leadership',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell">
    @foreach ($headings as $group => $heading)
        <div id="{{ $group }}" class="scroll-mt-32 {{ $loop->first ? '' : 'mt-20' }}">
            <div data-reveal>
                <h2 class="text-3xl font-semibold text-brand-900">{{ $heading }}</h2>
                <p class="section-sub">{{ $descriptions[$group] }}</p>
                <div class="section-divider"></div>
            </div>
            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($groups[$group] ?? [] as $member)
                    <div class="card overflow-hidden text-center" data-reveal>
                        @if ($member->photo && $member->photo !== 'Photo')
                            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="h-56 w-full object-cover" loading="lazy">
                        @elseif ($member->photo === 'Photo')
                            <div class="flex h-56 items-center justify-center bg-slate-100 text-sm text-slate-500">Photo</div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold">{{ $member->name }}</h3>
                            <p class="text-sm font-semibold text-brand-700">{{ $member->role }}</p>
                            @if ($member->location)
                                <p class="mt-1 text-sm text-slate-500">{{ $member->location }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
@endsection
