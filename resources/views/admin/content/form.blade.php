@extends('admin.layout')

@section('title', $item ? 'Edit '.$config['label'] : 'Create '.$config['label'])
@section('heading', $item ? 'Edit '.$config['label'] : 'Create '.$config['label'])

@section('content')
<div class="card max-w-4xl p-6">
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <ul class="list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $item ? route('admin.content.update', [$resource, $item->getAttribute($config['identifier'])]) : route('admin.content.store', $resource) }}" class="grid gap-5">
        @csrf
        @if ($item)
            @method('PUT')
        @endif

        @foreach ($config['fields'] as $name => $field)
            @php($required = in_array('required', $field['rules'], true))
            <div>
                <label for="field-{{ $name }}" class="block text-sm font-semibold">{{ $field['label'] }}</label>

                @if (in_array($field['type'], ['textarea', 'json'], true))
                    <textarea id="field-{{ $name }}" name="{{ $name }}" rows="{{ $field['type'] === 'json' ? 8 : 5 }}" @if ($required) required @endif class="mt-2 w-full rounded-xl border-slate-300 font-mono text-sm shadow-sm focus:border-brand-500 focus:ring-brand-500">{{ old($name, $values[$name] ?? '') }}</textarea>
                @else
                    <input id="field-{{ $name }}" name="{{ $name }}" type="{{ $field['type'] }}" value="{{ old($name, $values[$name] ?? '') }}" @if ($required) required @endif class="mt-2 w-full rounded-xl border-slate-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
                @endif
            </div>
        @endforeach

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="btn-primary">Save</button>
            <a href="{{ route('admin.content.index', $resource) }}" class="btn-secondary">Cancel</a>
            @if ($item)
                <form method="POST" action="{{ route('admin.content.destroy', [$resource, $item->getAttribute($config['identifier'])]) }}" onsubmit="return confirm('Delete this item?')" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn border border-red-200 text-red-600 hover:bg-red-50">Delete</button>
                </form>
            @endif
        </div>
    </form>
</div>
@endsection
