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
        Schema::create('ppdb_settings', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year')->default('2026/2027');
            $table->unsignedInteger('total_quota')->default(120);
            $table->boolean('is_active')->default(true);
            $table->date('registration_start_date')->nullable();
            $table->date('registration_end_date')->nullable();
            $table->date('announcement_date')->nullable();
            $table->decimal('registration_fee', 12, 2)->default(0);
            $table->string('contact_person')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('brochure_file')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_settings');
    }
};
