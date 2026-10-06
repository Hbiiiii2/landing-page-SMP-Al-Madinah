<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Helper to get the single school profile record (singleton pattern)
     */
    public static function current(): self
    {
        return static::firstOrCreate([], [
            'name' => 'SMP Al-Madinah',
            'accreditation' => 'A',
            'tagline' => 'Membentuk Generasi Berkarakter, Cerdas, dan Berakhlak Mulia',
            'statistic_students' => 350,
            'statistic_teachers' => 25,
            'statistic_achievements' => 48,
            'statistic_year_founded' => 2012,
        ]);
    }
}
