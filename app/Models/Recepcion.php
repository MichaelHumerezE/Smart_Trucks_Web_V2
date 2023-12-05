<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $table = "recepcions";

    protected $fillable = [
        'fechaHora',
        'cantidad',
        'observacion',
        'id_basura',
        'id_recorrido',
    ];

    public function basura()
    {
        return $this->belongsTo(Basura::class, 'id_basura');
    }

    public function recorrido()
    {
        return $this->belongsTo(Recorrido::class, 'id_recorrido');
    }
}
