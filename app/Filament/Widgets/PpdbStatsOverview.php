<?php

namespace App\Filament\Widgets;

use App\Models\PpdbRegistration;
use App\Models\PpdbSetting;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use TallCms\Cms\Models\CmsPost;

class PpdbStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $setting = PpdbSetting::current();
        $totalRegistered = PpdbRegistration::count();
        $pendingCount = PpdbRegistration::where('status', 'pending')->count();
        $remainingQuota = $setting ? $setting->remaining_quota : 0;
        $totalQuota = $setting ? $setting->total_quota : 0;
        $activePostsCount = class_exists(CmsPost::class) ? CmsPost::where('status', 'published')->count() : 0;

        return [
            Stat::make('Total Pendaftar', $totalRegistered)
                ->description('Calon siswa terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Kuota PPDB', $totalQuota)
                ->description('Tahun Ajaran ' . ($setting->academic_year ?? '-'))
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            Stat::make('Sisa Kuota Realtime', $remainingQuota)
                ->description($remainingQuota <= 0 ? 'STATUS: KUOTA PENUH' : 'Tersedia untuk pendaftar baru')
                ->descriptionIcon($remainingQuota <= 0 ? 'heroicon-m-x-circle' : 'heroicon-m-check-circle')
                ->color($remainingQuota <= 0 ? 'danger' : 'success'),

            Stat::make('Menunggu Verifikasi', $pendingCount)
                ->description($pendingCount > 0 ? 'Perlu tindakan verifikasi' : 'Semua pendaftar diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingCount > 0 ? 'warning' : 'gray'),

            Stat::make('Berita & Artikel Aktif', $activePostsCount)
                ->description('Publikasi CMS aktif')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),
        ];
    }
}
