<?php

namespace App\Providers;

use App\Models\PpdbSetting;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
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
        // Force HTTPS only behind reverse proxy (Cloudflare) or in production when NOT on localhost
        $isLocalhost = in_array(request()->getHost(), ['localhost', '127.0.0.1', '::1']);
        if (request()->header('X-Forwarded-Proto') === 'https' || (app()->environment('production') && !$isLocalhost)) {
            URL::forceScheme('https');
        }

        // Always generate root-relative URLs for Vite assets (/build/assets/...)
        // This guarantees CSS/JS load seamlessly across localhost, IP, custom ports, and production HTTPS
        Vite::createAssetPathsUsing(fn ($path) => '/' . ltrim($path, '/'));

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
