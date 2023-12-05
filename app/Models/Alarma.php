<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarma extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'fechaHora',
        'radio',
        'estado',
        'latitud',
        'longitud',
        'id_ruta',
        'id_cliente',
    ];
}
