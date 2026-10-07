<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\PpdbSetting;
use App\Models\SchoolEvent;
use App\Models\SchoolProfile;
use App\Models\SchoolProgram;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use TallCms\Cms\Models\CmsCategory;
use TallCms\Cms\Models\CmsPost;

class HomeController extends Controller
{
    public function index()
    {
        $profile = null;
        $ppdbSetting = null;
        $programs = collect();
        $achievements = collect();
        $facilities = collect();
        $extracurriculars = collect();
        $events = collect();
        $announcements = collect();
        $teachers = collect();
        $posts = collect();
        $categories = collect();

        try {
            if (Schema::hasTable('school_profiles')) {
                $profile = SchoolProfile::first();
            }

            if (Schema::hasTable('ppdb_settings')) {
                $ppdbSetting = PpdbSetting::where('is_active', true)->latest()->first() ?? PpdbSetting::first();
            }

            if (Schema::hasTable('school_programs')) {
                $programs = SchoolProgram::orderBy('order')->get();
            }

            if (Schema::hasTable('achievements')) {
                $achievements = Achievement::orderByDesc('is_featured')
                    ->orderByDesc('year')
                    ->take(6)
                    ->get();
            }

            if (Schema::hasTable('facilities')) {
                $facilities = Facility::orderBy('order')->take(6)->get();
            }

            if (Schema::hasTable('extracurriculars')) {
                $extracurriculars = Extracurricular::orderBy('order')->take(8)->get();
            }

            if (Schema::hasTable('school_events')) {
                $events = SchoolEvent::where('is_active', true)
                    ->orderBy('start_date')
                    ->take(3)
                    ->get();
            }

            if (Schema::hasTable('announcements')) {
                $announcements = Announcement::where('is_active', true)
                    ->latest()
                    ->take(3)
                    ->get();
            }

            if (Schema::hasTable('teachers')) {
                $teachers = Teacher::orderBy('order')->take(4)->get();
            }

            if (Schema::hasTable('tallcms_posts')) {
                $posts = CmsPost::published()
                    ->with(['categories', 'author'])
                    ->latest('published_at')
                    ->take(3)
                    ->get();
            }

            if (Schema::hasTable('tallcms_categories')) {
                $categories = CmsCategory::withCount(['posts' => function ($q) {
                    $q->published();
                }])->get();
            }
        } catch (\Throwable $e) {
            // Graceful fallback during migration or dev setup
        }

        return view('pages.home', compact(
            'profile',
            'ppdbSetting',
            'programs',
            'achievements',
            'facilities',
            'extracurriculars',
            'events',
            'announcements',
            'teachers',
            'posts',
            'categories'
        ));
    }
}
