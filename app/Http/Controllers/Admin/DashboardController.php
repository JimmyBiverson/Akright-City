<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Media;
use App\Models\NewsPost;
use App\Models\PageContent;
use App\Models\Village;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'villages' => Village::count(),
                'pages' => PageContent::count(),
                'news' => NewsPost::count(),
                'gallery' => GalleryImage::count(),
                'messages' => ContactMessage::where('is_read', false)->count(),
                'media' => Media::count(),
            ],
            'messages' => ContactMessage::latest()->take(5)->get(),
            'activity' => AuditLog::with('user')->latest()->take(10)->get(),
        ]);
    }
}
