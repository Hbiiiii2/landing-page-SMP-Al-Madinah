<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Extracurricular extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get image URL with safe public asset fallback
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!empty($this->image)) {
            if (Str::startsWith($this->image, ['http://', 'https://'])) {
                return $this->image;
            }
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Human-friendly category label
     */
    public function getCategoryLabelAttribute(): string
    {
        return match (strtolower($this->category ?? '')) {
            'wajib' => 'Ekstrakurikuler Wajib',
            'keagamaan' => 'Keagamaan & Tahfidz',
            'sains', 'sains_it' => 'Sains & Robotika',
            'olahraga' => 'Olahraga & Beladiri',
            'bahasa' => 'Bahasa & Public Speaking',
            'seni' => 'Seni & Multimedia',
            'pengembangan_diri' => 'Pengembangan Diri (PMR/UKS)',
            default => !empty($this->category) ? ucfirst($this->category) : 'Pengembangan Bakat',
        };
    }
}
