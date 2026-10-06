<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
