<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $primaryKey = 'niy';
    public $incrementing = false; // Assuming 'niy' is not auto-incrementing

    // Tentukan tipe data primary key
    protected $keyType = 'string'; // Karena 'niy' adalah string

    protected $fillable = [
        'niy','nama_pegawai','thn_masuk','unit_kerja','status_pegawai','foto'
    ];

    public function penggajian(){
        return $this->hasMany(Penggajian::class, 'niy', 'niy');
    }
}
