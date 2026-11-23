<?php

namespace App\Http\Controllers;

use App\Models\DirectoryEntry;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\NewsPost;
use App\Models\PageContent;
use App\Models\Partner;
use App\Models\Report;
use App\Models\TeamMember;
use App\Models\Video;
use App\Models\Village;
use Illuminate\Contracts\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $home = PageContent::where('key', 'home')->firstOrFail();
        $president = PageContent::where('key', 'president')->firstOrFail();
        $villages = Village::orderBy('sort_order')->get();
        $newsSlugs = ['the-akright-city-run-2026', 'international-womens-day', 'acra-2026-year-planner'];
        $news = NewsPost::whereIn('slug', $newsSlugs)
            ->get()
            ->sortBy(fn (NewsPost $post): int => (int) array_search($post->slug, $newsSlugs))
            ->values();
        $leadership = TeamMember::where('group', 'home-leadership')->orderBy('sort_order')->get();
        $partners = Partner::orderBy('sort_order')->get();

        return view('pages.home', compact('home', 'president', 'villages', 'news', 'leadership', 'partners'));
    }

    public function about(): View
    {
        return view('pages.about', ['page' => PageContent::where('key', 'about')->firstOrFail()]);
    }

    public function team(): View
    {
        $page = PageContent::where('key', 'team')->firstOrFail();
        $groupOrder = ['executive' => 1, 'council' => 2, 'conciliatory' => 3];
        $groups = TeamMember::whereIn('group', array_keys($groupOrder))
            ->get()
            ->sortBy(fn (TeamMember $member): array => [$groupOrder[$member->group] ?? 99, $member->sort_order])
            ->groupBy('group');

        return view('pages.team', compact('page', 'groups'));
    }

    public function villages(): View
    {
        return view('pages.villages.index', [
            'page' => PageContent::where('key', 'home')->firstOrFail(),
            'villages' => Village::orderBy('sort_order')->get(),
        ]);
    }

    public function village(string $slug): View
    {
        $village = Village::where('slug', $slug)->firstOrFail();

        return view('pages.villages.show', compact('village'));
    }

    public function reports(): View
    {
        $page = PageContent::where('key', 'reports')->firstOrFail();
        $reports = Report::orderBy('year', 'desc')
            ->orderBy('sort_order')
            ->get()
            ->groupBy(['year', 'category']);

        return view('pages.reports', compact('page', 'reports'));
    }

    public function directory(): View
    {
        $page = PageContent::where('key', 'directory')->firstOrFail();
        $categoryOrder = [
            'Schools' => 1,
            'Restaurants & Bars' => 2,
            'Churches / Mosque' => 3,
            'Services & Retail' => 4,
            'Utilities' => 5,
            'Sports & Recreation' => 6,
        ];
        $entries = DirectoryEntry::all()
            ->sortBy(fn (DirectoryEntry $entry): array => [$categoryOrder[$entry->category] ?? 99, $entry->sort_order])
            ->groupBy('category');

        return view('pages.directory', compact('page', 'entries'));
    }

    public function news(): View
    {
        return view('pages.news.index', [
            'page' => PageContent::where('key', 'news')->firstOrFail(),
            'posts' => NewsPost::orderBy('sort_order')->get(),
        ]);
    }

    public function newsPost(string $slug): View
    {
        $post = NewsPost::where('slug', $slug)->firstOrFail();

        return view('pages.news.show', compact('post'));
    }

    public function faqs(): View
    {
        return view('pages.faqs', [
            'page' => PageContent::where('key', 'faqs')->firstOrFail(),
            'faqs' => Faq::orderBy('sort_order')->get(),
        ]);
    }

    public function gallery(): View
    {
        $page = PageContent::where('key', 'gallery')->firstOrFail();
        $categoryOrder = [
            'Youth Day' => 1,
            'Akright Run' => 2,
            'ACRA Football tournament' => 3,
            'Mens Day' => 4,
            'Womens Day' => 5,
        ];
        $images = GalleryImage::all()
            ->sortBy(fn (GalleryImage $image): array => [-$image->year, $categoryOrder[$image->category] ?? 99, $image->sort_order])
            ->values();
        $years = $images->pluck('year')->unique()->values();

        return view('pages.gallery', compact('page', 'images', 'years'));
    }

    public function youtube(): View
    {
        return view('pages.youtube', [
            'page' => PageContent::where('key', 'youtube')->firstOrFail(),
            'videos' => Video::orderBy('sort_order')->get(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', ['page' => PageContent::where('key', 'contact')->firstOrFail()]);
    }

    public function payments(): View
    {
        return view('pages.payments', [
            'page' => PageContent::where('key', 'payments')->firstOr(function () {
                return PageContent::make([
                    'key' => 'payments',
                    'title' => 'Payments',
                    'subtitle' => 'Pay your ACRA subscription securely through the official Akright City payment portal.',
                    'meta_description' => 'Pay your ACRA subscription securely through the official Akright City payment portal.',
                ]);
            }),
            'paymentUrl' => 'https://my.akrightcity.com/?dad=index&jc=order&a=form&package=79',
        ]);
    }
}
