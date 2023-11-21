<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail'; // Sesuaikan dengan nama tabel yang benar
<<<<<<< HEAD
    protected $fillable = ['id_user', 'nama', 'tgl_lahir', 'alamat', 'no_telp', 'email', 'foto'];
=======
    protected $primaryKey = 'id_user'; // Sesuaikan dengan primary key yang benar

    protected $fillable = [
        'id_user',
        'nama',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'email',
        'foto',
        // Tambahkan kolom lain sesuai kebutuhan
    ];
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
        // Relasi dengan model User (asumsi model User sudah ada)
    public function user()
    {
         return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
