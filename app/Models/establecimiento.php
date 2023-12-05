<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class establecimiento extends Model
{
    use HasFactory;

    protected $table = "establecimientos";

    protected $fillable = [
        'nombre',
        'id_ruta',
        'id_distrito',
        'id_red',
    ];

    public function red()
    {
        return $this->belongsTo(Red::class, 'id_red');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }
}
