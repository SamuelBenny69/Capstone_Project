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
    Schema::create('gaji', function (Blueprint $table) {
        $table->id(); // Primary key auto-increment
        $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
        $table->integer('gaji_pokok', ); // Kolom gaji_pokok dengan tipe integer
        $table->integer('tunjangan_hadir', ); // Kolom uang_hadir dengan tipe integer
        $table->integer('tunjangan_keluarga', ); // Kolom uang_hadir dengan tipe integer
        $table->integer('asuransi', ); // Kolom uang_hadir dengan tipe integer

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
