<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    use HasFactory;

    protected $table = "reds";

    protected $fillable = [
        'nombre',
    ];

    public function establecimientos()
    {
        return $this->hasMany(establecimiento::class, 'id_red', 'id');
    }
}
