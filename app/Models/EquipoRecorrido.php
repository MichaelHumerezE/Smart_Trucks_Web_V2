<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoRecorrido extends Model
{
    use HasFactory;

    protected $table = "equipo_recorridos";

    protected $fillable = [
        'id',
        'id_empleado',
        'id_camion',
    ];

    public function recorridos()
    {
        return $this->hasMany(Recorrido::class, 'id_equipoRecorrido', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'id_empleado');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'id_camion');
    }
}
