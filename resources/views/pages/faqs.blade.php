@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Help & Info',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell max-w-5xl">
    <div class="space-y-4">
        @foreach ($faqs as $faq)
            <details class="card group p-6" @if ($loop->first) open @endif data-reveal>
                <summary class="flex cursor-pointer list-none items-start justify-between gap-4 font-semibold text-brand-900">{{ $faq->question }} <span class="text-xl leading-none text-brand-700 transition group-open:rotate-45" aria-hidden="true">+</span></summary>
                <div class="prose-content mt-4">{!! $faq->answer !!}</div>
            </details>
        @endforeach
    </div>
</section>
@endsection
