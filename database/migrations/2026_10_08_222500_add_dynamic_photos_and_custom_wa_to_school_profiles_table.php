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
            // 1. Photo & Badges for Section 05: "Mengapa Memilih Kami"
            $table->string('why_choose_us_image')->nullable()->after('hero_image');
            $table->string('why_choose_us_badge_title')->nullable()->after('why_choose_us_image');
            $table->string('why_choose_us_badge_subtitle')->nullable()->after('why_choose_us_badge_title');

            // 2. 4 Collage Photos for Section 07: "Daftar Sekarang Juga (PPDB Banner)"
            $table->string('cta_collage_image_1')->nullable()->after('why_choose_us_badge_subtitle');
            $table->string('cta_collage_image_2')->nullable()->after('cta_collage_image_1');
            $table->string('cta_collage_image_3')->nullable()->after('cta_collage_image_2');
            $table->string('cta_collage_image_4')->nullable()->after('cta_collage_image_3');

            // 3. Dynamic WhatsApp Contacts & Custom URLs
            $table->string('whatsapp_ppdb')->nullable()->after('whatsapp');
            $table->string('whatsapp_custom_url')->nullable()->after('whatsapp_ppdb');
            $table->text('whatsapp_message_panitia')->nullable()->after('whatsapp_custom_url');
            $table->text('whatsapp_message_brosur')->nullable()->after('whatsapp_message_panitia');
            $table->text('whatsapp_message_biaya')->nullable()->after('whatsapp_message_brosur');
            $table->text('whatsapp_message_floating')->nullable()->after('whatsapp_message_biaya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'why_choose_us_image',
                'why_choose_us_badge_title',
                'why_choose_us_badge_subtitle',
                'cta_collage_image_1',
                'cta_collage_image_2',
                'cta_collage_image_3',
                'cta_collage_image_4',
                'whatsapp_ppdb',
                'whatsapp_custom_url',
                'whatsapp_message_panitia',
                'whatsapp_message_brosur',
                'whatsapp_message_biaya',
                'whatsapp_message_floating',
            ]);
        });
    }
};
