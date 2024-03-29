<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'sparepart'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = 'kd_sparepart'; // Sesuaikan dengan primary key yang benar

    public $incrementing = false; // This line tells Laravel not to auto-increment the primary key

    protected $fillable = [
        'kd_sparepart',
        'nama_sparepart',
        'harga',
        'stok',
        'total_harga'
        // Tambahkan kolom lain sesuai kebutuhan
    ];
}
