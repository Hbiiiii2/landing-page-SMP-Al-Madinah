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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name');
            $table->string('category')->default('akademik'); // akademik, olahraga, seni, keagamaan, sains, lainnya
            $table->string('level')->default('kabupaten'); // kecamatan, kabupaten, provinsi, nasional, internasional
            $table->string('rank')->nullable(); // Juara 1, Emas, Harapan 1, dll
            $table->unsignedSmallInteger('year');
            $table->date('event_date')->nullable();
            $table->string('organizer')->nullable();
            $table->string('photo')->nullable();
            $table->string('certificate_file')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
