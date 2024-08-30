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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran')->autoIncrement();
            $table->string('niy')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->time('waktu_masuk')->nullable();
            $table->string('image_path')->nullable(); // Menyimpan path gambar wajah
            $table->string('image_name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
