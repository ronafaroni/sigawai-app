<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';

    protected $fillable = ['niy', 'nama_pegawai', 'jenis_izin', 'keterangan_cuti', 'tgl_mulai_izin', 'tgl_selesai_izin', 'alasan_izin', 'status_izin', 'file_izin'];
}
