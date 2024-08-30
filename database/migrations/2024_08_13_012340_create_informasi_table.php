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
        Schema::create('informasi', function (Blueprint $table) {
            $table->id('id_informasi');
            $table->string('nama_informasi')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('jenis_informasi')->nullable();
            $table->string('status_informasi')->nullable();
            $table->string('file_informasi')->nullable();
            $table->string('link_informasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
