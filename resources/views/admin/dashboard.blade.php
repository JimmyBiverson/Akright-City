@extends('admin.layout')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
    @foreach ($counts as $label => $count)
        <div class="card p-5">
            <p class="text-sm capitalize text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-3xl font-bold">{{ $count }}</p>
        </div>
    @endforeach
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-2">
    <section class="card overflow-hidden">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4 font-semibold">Recent Messages</div>
        <ul class="divide-y divide-slate-100">
            @forelse ($messages as $message)
                <li class="px-6 py-4">
                    <a href="{{ route('admin.messages.show', $message) }}" class="font-semibold hover:text-brand-700">{{ $message->subject }}</a>
                    <p class="text-sm text-slate-500">{{ $message->name }} · {{ $message->created_at->diffForHumans() }}</p>
                </li>
            @empty
                <li class="px-6 py-4 text-sm text-slate-500">No messages yet.</li>
            @endforelse
        </ul>
    </section>

    <section class="card overflow-hidden">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4 font-semibold">Recent Activity</div>
        <ul class="divide-y divide-slate-100">
            @forelse ($activity as $log)
                <li class="px-6 py-4 text-sm">
                    <p>{{ $log->description }}</p>
                    <p class="text-slate-500">{{ $log->user?->name ?? 'System' }} · {{ $log->created_at->diffForHumans() }}</p>
                </li>
            @empty
                <li class="px-6 py-4 text-sm text-slate-500">No activity yet.</li>
            @endforelse
        </ul>
    </section>
</div>
@endsection
