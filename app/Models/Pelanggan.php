<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = 'id_pelanggan'; // Sesuaikan dengan primary key yang benar

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'no_telp',
        'email',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi dengan model Penjualan (asumsi model Penjualan sudah ada)
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
