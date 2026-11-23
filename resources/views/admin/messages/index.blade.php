@extends('admin.layout')

@section('title', 'Messages')
@section('heading', 'Messages')

@section('content')
<div class="card overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
            <tr>
                <th class="px-5 py-3">Subject</th>
                <th class="px-5 py-3">From</th>
                <th class="px-5 py-3">Received</th>
                <th class="px-5 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($messages as $message)
                <tr>
                    <td class="px-5 py-3"><a href="{{ route('admin.messages.show', $message) }}" class="font-semibold hover:text-brand-700">{{ $message->subject }}</a></td>
                    <td class="px-5 py-3">{{ $message->name }}<br><span class="text-slate-500">{{ $message->email }}</span></td>
                    <td class="px-5 py-3">{{ $message->created_at->format('M j, Y') }}</td>
                    <td class="px-5 py-3">{{ $message->is_read ? 'Read' : 'Unread' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-6 text-center text-slate-500">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $messages->links() }}</div>
@endsection
