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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id(); // Primary key bigInteger auto-increment
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade'); // Foreign key ke tabel jabatan
            $table->string('nama', 100); // Kolom nama dengan tipe string, panjang maksimum 100 karakter
            $table->enum('jkel', ['L', 'P']); // Kolom jkel dengan enum 'L' (Laki-laki) dan 'P' (Perempuan)
            $table->enum('status', ['aktif', 'non-aktif']); // Kolom status dengan enum 'aktif' dan 'non-aktif'

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
