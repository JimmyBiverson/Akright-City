<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(): View
    {
        return view('admin.media.index', [
            'items' => Media::latest()->paginate(25),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');
        $media = Media::create([
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'alt_text' => $validated['alt_text'] ?? null,
            'uploaded_by' => auth()->id(),
        ]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'uploaded',
            'subject_type' => Media::class,
            'subject_id' => $media->getKey(),
            'description' => "Uploaded media file {$media->original_name}",
        ]);

        return back()->with('status', 'File uploaded.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return back()->with('status', 'File deleted.');
    }
}
