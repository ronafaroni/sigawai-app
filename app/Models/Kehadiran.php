<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';

    protected $primaryKey = 'id_kehadiran';

    protected $fillable = [
        'niy', 'nama_pegawai', 'tanggal_masuk', 'waktu_masuk', 'image_path', 'latitude', 'longitude'
    ];
    
}
