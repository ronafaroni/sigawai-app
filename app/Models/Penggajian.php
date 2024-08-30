<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian';

    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'niy',
        'bln_gaji',
        'thn_gaji',
        'gaji_pokok',
        'tunjangan_struktural',
        'tunjangan_pengabdian',
        'tunjangan_keluarga',
        'tunjangan_anak',
        'tunjangan_beras',
        'tunjangan_kinerja',
        'besaran_transport',
        'harian_transport',
        'jumlah_transport',
        'tambahan_jam',
        'jumlah_gaji',
        'tambahan_fungsi',
        'besaran_jam_mengajar',
        'satuan_jam_mengajar',
        'jumlah_jam_mengajar',
        'besaran_jam_mengaji',
        'satuan_jam_mengaji',
        'jumlah_jam_mengaji',
        'tunjangan_hari_raya',
        'total_tambahan',
        'besaran_potongan_transport',
        'satuan_potongan_transport',
        'jumlah_potongan_transport',
        'besaran_potongan_jam_mengajar',
        'satuan_potongan_jam_mengajar',
        'jumlah_potongan_jam_mengajar',
        'besaran_potongan_jam_mengaji',
        'satuan_potongan_jam_mengaji',
        'jumlah_potongan_jam_mengaji',
        'total_potongan',
        'total_seluruh_gaji',
        'potongan_dana_pensiun',
        'potongan_dana_kredit',
        'potongan_dana_sosial',
        'potongan_bpjs',
        'potongan_arisan',
        'potongan_lain',
        'total_gaji_diterima',
    ];

    public function Pegawai(){
        return $this->belongsTo(Pegawai::class, 'niy', 'niy');
    }

}
