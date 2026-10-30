<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Achievement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'year' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get photo URL with safe fallback
     */
    public function getPhotoUrlAttribute(): string
    {
        if (!empty($this->photo)) {
            if (Str::startsWith($this->photo, ['http://', 'https://'])) {
                return $this->photo;
            }
            return asset('storage/' . $this->photo);
        }
        return 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=700&q=80';
    }

    /**
     * Human-friendly level label
     */
    public function getLevelLabelAttribute(): string
    {
        return match (strtolower($this->level ?? '')) {
            'internasional' => 'Tingkat Internasional',
            'nasional' => 'Tingkat Nasional',
            'provinsi' => 'Tingkat Provinsi',
            'kabupaten', 'kota' => 'Tingkat Kota / Kab',
            'kecamatan' => 'Tingkat Kecamatan',
            default => 'Tingkat ' . ucfirst($this->level ?? 'Kompetisi'),
        };
    }

    /**
     * Human-friendly category label
     */
    public function getCategoryLabelAttribute(): string
    {
        return match (strtolower($this->category ?? '')) {
            'keagamaan' => 'Keagamaan / MTQ',
            'akademik' => 'Akademik',
            'sains' => 'Sains & Robotik',
            'olahraga' => 'Olahraga',
            'seni' => 'Seni & Budaya',
            default => ucfirst($this->category ?? 'Prestasi Santri'),
        };
    }
}
