<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\SchoolEvent;
use App\Models\SchoolProfile;
use App\Models\SchoolProgram;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use TallCms\Cms\Models\CmsCategory;
use TallCms\Cms\Models\CmsPost;

class PublicPageController extends Controller
{
    /**
     * Halaman Tentang Kami / Profil Sekolah
     */
    public function about()
    {
        $profile = SchoolProfile::first();
        $teachers = Teacher::orderBy('order')->get();
        $facilities = Facility::orderBy('order')->get();

        return view('pages.about', compact('profile', 'teachers', 'facilities'));
    }

    /**
     * Halaman Program Pendidikan & Kurikulum
     */
    public function programs()
    {
        $profile = SchoolProfile::first();
        $programs = SchoolProgram::orderBy('order')->get();
        $extracurriculars = Extracurricular::orderBy('order')->get();

        return view('pages.programs', compact('profile', 'programs', 'extracurriculars'));
    }

    /**
     * Halaman Etalase Prestasi Siswa
     */
    public function achievements()
    {
        $profile = SchoolProfile::first();
        $achievements = Achievement::orderByDesc('year')->orderByDesc('is_featured')->paginate(12);

        return view('pages.achievements', compact('profile', 'achievements'));
    }

    /**
     * Halaman Galeri Kegiatan
     */
    public function gallery()
    {
        $profile = SchoolProfile::first();
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery', compact('profile', 'galleries'));
    }

    /**
     * Halaman Berita & Warta (Integrasi TallCMS)
     */
    public function news(Request $request)
    {
        $profile = SchoolProfile::first();
        $posts = collect();
        $categories = collect();
        $events = collect();

        if (Schema::hasTable('tallcms_posts')) {
            $query = CmsPost::published()->with(['categories', 'author']);

            if ($search = $request->input('q')) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            }

            if ($categorySlug = $request->input('kategori')) {
                $query->whereHas('categories', function ($q) use ($categorySlug) {
                    $locale = config('app.locale', 'en');
                    $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(slug, '$.\"".$locale."\"')) = ?", [$categorySlug])
                      ->orWhere('slug', 'like', "%{$categorySlug}%");
                });
            }

            $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        }

        if (Schema::hasTable('tallcms_categories')) {
            $categories = CmsCategory::withCount(['posts' => function ($q) {
                $q->published();
            }])->get();
        }

        if (Schema::hasTable('school_events')) {
            $events = SchoolEvent::where('is_active', true)->orderBy('start_date')->take(5)->get();
        }

        return view('pages.news.index', compact('profile', 'posts', 'categories', 'events'));
    }

    /**
     * Detail Berita & Warta (Integrasi TallCMS dengan fallback slug & ID)
     */
    public function newsDetail($slugOrId)
    {
        $profile = SchoolProfile::first();
        $post = null;

        if (Schema::hasTable('tallcms_posts')) {
            $locale = config('app.locale', 'en');
            $post = CmsPost::published()
                ->with(['categories', 'author'])
                ->where(function ($q) use ($slugOrId, $locale) {
                    $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(slug, '$.\"".$locale."\"')) = ?", [$slugOrId])
                      ->orWhere('slug', 'like', "%\"{$slugOrId}\"%")
                      ->orWhere('id', $slugOrId);
                })
                ->first();

            // Beri akses pratinjau jika sudah login ke admin panel
            if (! $post && auth()->check()) {
                $post = CmsPost::with(['categories', 'author'])
                    ->where(function ($q) use ($slugOrId, $locale) {
                        $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(slug, '$.\"".$locale."\"')) = ?", [$slugOrId])
                          ->orWhere('slug', 'like', "%\"{$slugOrId}\"%")
                          ->orWhere('id', $slugOrId);
                    })
                    ->first();
            }
        }

        // Fallback untuk legacy Announcement jika diakses melalui ID lama
        if (! $post && Schema::hasTable('announcements')) {
            $announcement = Announcement::find($slugOrId);
            if ($announcement) {
                $post = (object) [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'slug' => (string) $announcement->id,
                    'excerpt' => Str::limit($announcement->message, 140),
                    'content' => '<p>' . nl2br(e($announcement->message)) . '</p>',
                    'featured_image' => null,
                    'published_at' => $announcement->created_at,
                    'created_at' => $announcement->created_at,
                    'categories' => collect([(object) ['name' => ucfirst($announcement->type ?? 'Pengumuman'), 'slug' => 'pengumuman']]),
                    'author' => (object) ['name' => 'Humas YKKM BSD'],
                ];
            }
        }

        if (! $post) {
            abort(404, 'Berita atau artikel tidak ditemukan.');
        }

        $recentPosts = collect();
        if (Schema::hasTable('tallcms_posts')) {
            $recentPosts = CmsPost::published()
                ->where('id', '!=', $post->id ?? 0)
                ->latest('published_at')
                ->take(4)
                ->get();
        }

        return view('pages.news.show', compact('profile', 'post', 'recentPosts'));
    }
}
