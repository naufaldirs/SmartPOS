<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
<<<<<<< HEAD
    protected $table = 'sparepart'; // Sesuaikan dengan nama tabel yang benar
=======
    protected $table = 'spareparts'; // Sesuaikan dengan nama tabel yang benar
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
    protected $primaryKey = 'kd_sparepart'; // Sesuaikan dengan primary key yang benar

    protected $fillable = [
        'kd_sparepart',
        'nama_sparepart',
        'harga',
        'stok',
        // Tambahkan kolom lain sesuai kebutuhan
    ];
}
