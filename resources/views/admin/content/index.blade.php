@extends('admin.layout')

@section('title', $config['label'])
@section('heading', $config['label'])

@section('content')
<div class="mb-5 flex items-center justify-between gap-4">
    <p class="text-sm text-slate-500">Manage {{ strtolower($config['label']) }} records.</p>
    <a href="{{ route('admin.content.create', $resource) }}" class="btn-primary">Add New</a>
</div>

<div class="card overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
            <tr>
                @foreach (array_slice($config['fields'], 0, 4, true) as $field)
                    <th class="px-5 py-3">{{ $field['label'] }}</th>
                @endforeach
                <th class="px-5 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($items as $item)
                <tr>
                    @foreach (array_slice($config['fields'], 0, 4, true) as $name => $field)
                        @php($value = data_get($item, $name))
                        <td class="px-5 py-3">{{ \Illuminate\Support\Str::limit(is_array($value) ? json_encode($value) : (string) $value, 60) }}</td>
                    @endforeach
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.content.edit', [$resource, $item->getAttribute($config['identifier'])]) }}" class="font-semibold text-brand-700">Edit</a>
                            <form method="POST" action="{{ route('admin.content.destroy', [$resource, $item->getAttribute($config['identifier'])]) }}" onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-semibold text-red-600">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-6 text-center text-slate-500">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $items->links() }}</div>
@endsection
