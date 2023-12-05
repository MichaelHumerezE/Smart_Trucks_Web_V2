<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $table = "rutas";

    protected $fillable = [
        'nombre',
        'descripcion',
        'origen',
        'destino',
        'coordenadas',
        'id_horario',
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    public function establecimientos()
    {
        return $this->hasMany(establecimiento::class, 'id_ruta', 'id');
    }

    public function areasCriticas()
    {
        return $this->hasMany(AreaCritica::class, 'id_ruta', 'id');
    }

    public function recorridos()
    {
        return $this->hasMany(Recorrido::class, 'id_ruta', 'id');
    }
}
