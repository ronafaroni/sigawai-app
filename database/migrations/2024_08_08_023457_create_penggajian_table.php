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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->string('niy')->nullable();
            $table->string('bln_gaji')->nullable();
            $table->string('thn_gaji')->nullable();
            // Data Penggajian
            $table->string('gaji_pokok')->nullable();
            $table->string('tunjangan_struktural')->nullable();
            $table->string('tunjangan_pengabdian')->nullable();
            $table->string('tunjangan_keluarga')->nullable();
            $table->string('tunjangan_anak')->nullable();
            $table->string('tunjangan_beras')->nullable();
            $table->string('tunjangan_kinerja')->nullable();
            // Data Tunjangan Transport
            $table->string('besaran_transport')->nullable();
            $table->string('harian_transport')->nullable();
            $table->string('jumlah_transport')->nullable();
            $table->string('tambahan_jam')->nullable();
            // Data Jumlah Gaji
            $table->string('jumlah_gaji')->nullable();
            // Data Tambahan Mengajar
            $table->string('tambahan_fungsi')->nullable();
            $table->string('besaran_jam_mengajar')->nullable();
            $table->string('satuan_jam_mengajar')->nullable();
            $table->string('jumlah_jam_mengajar')->nullable();
            // Data Tambahan Mengaji
            $table->string('besaran_jam_mengaji')->nullable();
            $table->string('satuan_jam_mengaji')->nullable();
            $table->string('jumlah_jam_mengaji')->nullable();
            // Data Tambahan
            $table->string('tunjangan_hari_raya')->nullable();
            $table->string('total_tambahan')->nullable();   
            // Data Potongan Transport
            $table->string('besaran_potongan_transport')->nullable();
            $table->string('satuan_potongan_transport')->nullable();
            $table->string('jumlah_potongan_transport')->nullable();
            // Data Potongan Mengajar
            $table->string('besaran_potongan_jam_mengajar')->nullable();
            $table->string('satuan_potongan_jam_mengajar')->nullable();
            $table->string('jumlah_potongan_jam_mengajar')->nullable();
            // Data Tambahan Mengaji
            $table->string('besaran_potongan_jam_mengaji')->nullable();
            $table->string('satuan_potongan_jam_mengaji')->nullable();
            $table->string('jumlah_potongan_jam_mengaji')->nullable();
            // Data Jumlah POtongan
            $table->string('total_potongan')->nullable();
            // Data Total Gaji
            $table->string('total_seluruh_gaji')->nullable();
            // Data Potongan Gaji
            $table->string('potongan_dana_pensiun')->nullable();
            $table->string('potongan_dana_kredit')->nullable();
            $table->string('potongan_dana_sosial')->nullable();
            $table->string('potongan_bpjs')->nullable();
            $table->string('potongan_arisan')->nullable();
            $table->string('potongan_lain')->nullable();
            // Data Total Gaji Diterima
            $table->string('total_gaji_diterima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
