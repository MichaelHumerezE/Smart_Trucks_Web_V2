<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    use HasFactory;

    protected $table = "recorridos";

    protected $fillable = [
        'fechaHora',
        'horaIni',
        'horaFin',
        'coordenadas',
        'id_equipoRecorrido',
        'id_ruta',
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }

    public function equipoRecorrido()
    {
        return $this->belongsTo(EquipoRecorrido::class, 'id_equipoRecorrido');
    }

    public function recepciones()
    {
        return $this->hasMany(Recepcion::class, 'id_recorrido', 'id');
    }
}
