<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastResult extends Model
{
    protected $fillable = ['no', 'periode', 'actual', 'forecast', 'mad', 'mse', 'mape'];
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'kd_sparepart', 'kd_sparepart');
    }
}
