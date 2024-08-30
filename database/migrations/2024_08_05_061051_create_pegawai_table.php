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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('niy');
            $table->string('nama_pegawai');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('jenis_kelamin');
            $table->string('email');
            $table->string('pendidikan');
            $table->string('thn_masuk');
            $table->string('thn_keluar');
            $table->string('unit_kerja');
            $table->string('status_pegawai');
            $table->string('status_kerja');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
