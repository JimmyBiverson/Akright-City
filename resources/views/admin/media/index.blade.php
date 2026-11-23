@extends('admin.layout')

@section('title', 'Media')
@section('heading', 'Media')

@section('content')
<div class="card mb-6 p-6">
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="grid gap-4 sm:grid-cols-[2fr,1fr,auto] sm:items-end">
        @csrf
        <div>
            <label for="file" class="block text-sm font-semibold">File</label>
            <input id="file" name="file" type="file" required accept=".jpg,.jpeg,.png,.webp,.pdf" class="mt-2 w-full text-sm">
        </div>
        <div>
            <label for="alt_text" class="block text-sm font-semibold">Alt Text</label>
            <input id="alt_text" name="alt_text" type="text" class="mt-2 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
        </div>
        <button type="submit" class="btn-primary">Upload</button>
    </form>
</div>

<div class="card overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
            <tr>
                <th class="px-5 py-3">Preview</th>
                <th class="px-5 py-3">File</th>
                <th class="px-5 py-3">Size</th>
                <th class="px-5 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($items as $item)
                <tr>
                    <td class="px-5 py-3">
                        @if (str_starts_with($item->mime ?? '', 'image/'))
                            <img src="{{ Storage::url($item->path) }}" alt="{{ $item->alt_text ?? $item->original_name }}" class="h-14 w-14 rounded-lg object-cover">
                        @else
                            <span class="text-slate-400">PDF</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <a href="{{ Storage::url($item->path) }}" target="_blank" rel="noopener noreferrer" class="font-semibold hover:text-brand-700">{{ $item->original_name }}</a>
                    </td>
                    <td class="px-5 py-3">{{ number_format($item->size / 1024, 1) }} KB</td>
                    <td class="px-5 py-3">
                        <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Delete this file?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-semibold text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-6 text-center text-slate-500">No media uploaded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $items->links() }}</div>
@endsection
