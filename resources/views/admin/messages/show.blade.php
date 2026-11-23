@extends('admin.layout')

@section('title', $message->subject)
@section('heading', 'Message')

@section('content')
<div class="card max-w-4xl p-6">
    <dl class="grid gap-4 sm:grid-cols-2">
        <div><dt class="text-xs uppercase tracking-wider text-slate-500">Name</dt><dd class="font-semibold">{{ $message->name }}</dd></div>
        <div><dt class="text-xs uppercase tracking-wider text-slate-500">Email</dt><dd class="font-semibold">{{ $message->email }}</dd></div>
        <div><dt class="text-xs uppercase tracking-wider text-slate-500">Subject</dt><dd class="font-semibold">{{ $message->subject }}</dd></div>
        <div><dt class="text-xs uppercase tracking-wider text-slate-500">Received</dt><dd class="font-semibold">{{ $message->created_at->format('F j, Y g:i a') }}</dd></div>
    </dl>
    <div class="mt-6 rounded-xl bg-slate-50 p-5 whitespace-pre-line">{{ $message->message }}</div>
    <div class="mt-6 flex gap-3">
        <a href="{{ route('admin.messages.index') }}" class="btn-secondary">Back to messages</a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn border border-red-200 text-red-600 hover:bg-red-50">Delete</button>
        </form>
    </div>
</div>
@endsection
