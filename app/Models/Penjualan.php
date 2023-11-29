<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = 'no_nota'; // Sesuaikan dengan primary key yang benar

    protected $fillable = [
        'no_nota',
        'tgl_nota',
        'keterangan',
        'pembayaran',
        'total',
        'bayar',
        'kembali',
        'id_pelanggan',
        'id_user',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi dengan model Pelanggan (asumsi model Pelanggan sudah ada)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // Relasi dengan model User (asumsi model User sudah ada)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::class, 'no_nota', 'no_nota');
    }
}
