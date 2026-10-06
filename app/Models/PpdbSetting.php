<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'registration_start_date' => 'date',
            'registration_end_date' => 'date',
            'announcement_date' => 'date',
            'registration_fee' => 'decimal:2',
            'total_quota' => 'integer',
        ];
    }

    public static function current(): self
    {
        return static::where('is_active', true)->latest()->first() ?? static::firstOrCreate([], [
            'academic_year' => '2026/2027',
            'total_quota' => 120,
            'is_active' => true,
        ]);
    }

    /**
     * Sisa Kuota = Total Kuota - Jumlah Pendaftar Valid (status: verified / accepted)
     */
    public function getRemainingQuotaAttribute(): int
    {
        $validCount = PpdbRegistration::where('academic_year', $this->academic_year)
            ->whereIn('status', ['verified', 'accepted'])
            ->count();

        return max(0, $this->total_quota - $validCount);
    }

    /**
     * Total pendaftar terdaftar
     */
    public function getTotalRegisteredAttribute(): int
    {
        return PpdbRegistration::where('academic_year', $this->academic_year)->count();
    }

    public function isQuotaFull(): bool
    {
        return $this->remaining_quota <= 0;
    }
}
