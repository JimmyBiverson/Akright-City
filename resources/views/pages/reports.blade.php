@extends('layouts.app')

@section('title', $page->title)
@section('description', $page->meta_description ?? $page->subtitle)

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Documents',
    'title' => $page->title,
    'subtitle' => $page->subtitle,
])

<section class="container-site content-shell" data-tabs>
    <div class="flex flex-wrap gap-3" role="tablist" aria-label="Report years" data-reveal>
        @foreach ($reports->keys() as $year)
            <button type="button" class="tab-button {{ $loop->first ? 'is-active' : '' }}" data-tab-button="{{ $year }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $year }}</button>
        @endforeach
    </div>

    @foreach ($reports as $year => $categories)
        <div class="mt-10 {{ $loop->first ? '' : 'hidden' }}" data-tab-panel="{{ $year }}">
            @foreach ($categories as $category => $items)
                <div class="card feature-panel mt-5 overflow-hidden" data-reveal>
                    <div class="border-b border-slate-200 bg-brand-50 px-6 py-4 font-semibold text-brand-900">{{ $category }}</div>
                    <ul class="divide-y divide-slate-100">
                        @foreach ($items as $report)
                            <li class="flex flex-wrap items-center justify-between gap-3 px-6 py-4">
                                <span>{{ $report->title }}</span>
                                @if ($report->path)
                                    <a href="{{ $report->path }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-brand-700">{{ $report->title }} ↗</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endforeach
</section>
@endsection
