<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'verified_at' => 'datetime',
            'additional_documents' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->registration_number)) {
                $year = date('Y');
                $count = static::whereYear('created_at', $year)->count() + 1;
                $model->registration_number = sprintf('REG-%s-%04d', $year, $count);
            }

            if (empty($model->academic_year)) {
                $setting = PpdbSetting::current();
                $model->academic_year = $setting->academic_year ?? date('Y') . '/' . (date('Y') + 1);
            }
        });
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'verified' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }
}
