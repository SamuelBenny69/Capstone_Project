<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('jabatan', function (Blueprint $table) {
        $table->id(); // Primary key auto-increment
        $table->string('kode_jabatan',10)->Unique();
        $table->string('jabatan', 100); // Kolom jabatan dengan tipe string, panjang maksimum 100 karakter
       
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
