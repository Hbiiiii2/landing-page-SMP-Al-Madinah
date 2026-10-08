<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('hero_badge_title')->nullable()->after('hero_image');
            $table->string('hero_badge_subtitle')->nullable()->after('hero_badge_title');
            $table->string('hero_badge_tag')->nullable()->after('hero_badge_subtitle');
            $table->string('ppdb_qr_code')->nullable()->after('hero_badge_tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge_title',
                'hero_badge_subtitle',
                'hero_badge_tag',
                'ppdb_qr_code',
            ]);
        });
    }
};
