<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';

    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'nama_informasi','deskripsi','jenis_informasi','status_informasi','file_informasi','link_informasi'
    ];
}
