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
    Schema::create('gaji_karyawan', function (Blueprint $table) {
        $table->id(); // Primary key auto-increment
        $table->date('tgl_gaji'); // Kolom tgl_gaji dengan tipe date
        $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Foreign key ke tabel karyawan
        $table->foreignId('gaji_id')->constrained('gaji')->onDelete('cascade');
        $table->timestamps(); // Kolom created_at dan updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_karyawan');
    }
};
