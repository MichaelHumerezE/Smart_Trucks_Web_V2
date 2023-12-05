<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = "distritos";

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_zona',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'id_zona');
    }

    public function establecimientos()
    {
        return $this->hasMany(establecimiento::class, 'id_distrito', 'id');
    }
}
