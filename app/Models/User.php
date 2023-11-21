<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
<<<<<<< HEAD
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'nip',
        'password',
        'role',
=======
    protected $fillable = [
        'nip',
        'password',
        'jabatan',
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
<<<<<<< HEAD
=======
        'password',
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
<<<<<<< HEAD
        'password' => 'hashed',
    ];

    public function userDetail() {
        return $this->hasOne(UserDetail::class, 'id_user', 'id_user');
    }

public function penjualan() {
    return $this->hasMany(Penjualan::class, 'id_user', 'id_user');

} 
    
=======
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
>>>>>>> 41f3074920338fa150f92d37fa962d2bc1706f0c
}
