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
        Schema::create('absens', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Foreign key ke tabel karyawan
            $table->string('nama', 100); // Kolom nama dengan tipe string, panjang maksimum 100 karakter
            $table->date('tgl_absen'); // Kolom tgl_absen dengan tipe date


        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
