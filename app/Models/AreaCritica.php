<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaCritica extends Model
{
    use HasFactory;

    protected $table = "area_criticas";

    protected $fillable = [
        'latitud',
        'longitud',
        'radio',
        'id_ruta',
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }
}
