<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facility extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
            'gallery' => 'array',
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
     * URL foto utama fasilitas yang aman untuk storage lokal maupun URL eksternal.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }

        if (Str::startsWith($this->photo, ['http://', 'https://'])) {
            return $this->photo;
        }

        return asset('storage/' . $this->photo);
    }

    /**
     * Kumpulan URL foto-foto galeri fasilitas.
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (empty($this->gallery) || !is_array($this->gallery)) {
            return [];
        }

        return array_map(function ($item) {
            if (Str::startsWith($item, ['http://', 'https://'])) {
                return $item;
            }
            return asset('storage/' . $item);
        }, $this->gallery);
    }

    /**
     * Semua foto fasilitas (foto utama + galeri).
     */
    public function getAllPhotosAttribute(): array
    {
        $photos = [];
        if ($this->photo_url) {
            $photos[] = $this->photo_url;
        }

        foreach ($this->gallery_urls as $url) {
            if (!in_array($url, $photos)) {
                $photos[] = $url;
            }
        }

        return $photos;
    }
}
