<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = 'kd_sparepart'; // Sesuaikan dengan primary key yang benar

    protected $fillable = [
        'kd_sparepart',
        'nama_sparepart',
        'harga',
        'stok',
        // Tambahkan kolom lain sesuai kebutuhan
    ];
}
