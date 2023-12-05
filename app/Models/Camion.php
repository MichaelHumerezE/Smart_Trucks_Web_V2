<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;

    protected $table = "camions";

    protected $fillable = [
        'nombre',
        'placa',
        'image',
        'carpeta',
        'capacidad_personal',
        'capacidad_carga',
    ];

    public function equiposRecorrido()
    {
        return $this->hasMany(EquipoRecorrido::class, 'id_camion', 'id');
    }
}
