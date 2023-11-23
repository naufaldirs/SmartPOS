<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $table = 'penjualan_detail'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = null; // Karena tidak ada primary key di tabel ini

    protected $fillable = [
        'no_nota',
        'kd_sparepart',
        'qty',
        'subtotal',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    // Relasi dengan model Penjualan (asumsi model Penjualan sudah ada)
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'no_nota', 'no_nota');
    }

    // Relasi dengan model Sparepart (asumsi model Sparepart sudah ada)
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'kd_sparepart', 'kd_sparepart');
    }
}
