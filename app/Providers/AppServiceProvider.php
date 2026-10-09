<?php

namespace App\Providers;

use App\Models\PpdbSetting;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only in production or behind a reverse proxy (Cloudflare Tunnel, etc.)
        if (app()->environment('production') || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        Storage::disk('local')->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
            return URL::temporarySignedRoute(
                'secure.private.file',
                $expiration,
                ['path' => $path]
            );
        });

        // Share schoolProfile and ppdbSetting to public views and components with safe fallback
        View::composer(['layouts.public', 'components.public.*'], function ($view) {
            $profile = null;
            $ppdbSetting = null;

            try {
                if (Schema::hasTable('school_profiles')) {
                    $profile = SchoolProfile::first();
                }
                if (Schema::hasTable('ppdb_settings')) {
                    $ppdbSetting = PpdbSetting::where('is_active', true)->latest()->first();
                }
            } catch (\Throwable $e) {
                // Graceful fallback if database is unavailable or migrating
            }

            $view->with([
                'schoolProfile' => $profile,
                'profile' => $profile,
                'ppdbSetting' => $ppdbSetting,
            ]);
        });
    }
}
