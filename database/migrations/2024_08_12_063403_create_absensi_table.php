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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->string('niy');
            $table->string('nama_pegawai');
            $table->string('jenis_izin');
            $table->string('keterangan_cuti');
            $table->date('tgl_mulai_izin');
            $table->date('tgl_selesai_izin');
            $table->string('status_izin');
            $table->string('file_izin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
