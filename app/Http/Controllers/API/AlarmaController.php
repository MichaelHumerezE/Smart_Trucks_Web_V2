<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alarma;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class AlarmaController extends Controller
{
    //Register alarma
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'radio' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'id_ruta' => 'required',
        ]);

        //create alarma
        $alarma = Alarma::create([
            'radio' => $attrs['radio'],
            'latitud' => $attrs['latitud'],
            'longitud' => $attrs['longitud'],
            'id_ruta' => $attrs['id_ruta'],
            'id_cliente' => Auth::id(),
            'fechaHora' => date('Y-m-d H:i:s'),
            'estado' => '1'
        ]);

        //return alarma
        return response([
            'user' => $alarma,
        ], 200);
    }

    public function getRutas()
    {
        $rutas = Ruta::join('establecimientos', 'rutas.id', 'establecimientos.id_ruta')
            ->join('distritos', 'establecimientos.id_distrito', 'distritos.id')
            ->join('zonas', 'distritos.id_zona', 'zonas.id')
            ->select('rutas.id', 'rutas.nombre', 'rutas.descripcion', 
            'establecimientos.nombre AS establecimientos', 
            'distritos.nombre AS distrito', 'zonas.nombre AS zona')
            ->orderBy('rutas.id', 'ASC')->get();
        return response([
            'rutas' => $rutas
        ], 200);
    }

    public function getRuta($id)
    {
        $ruta = Ruta::findOrFail($id);
        return response([
            'ruta' => $ruta
        ], 200);
    }

    public function getAlarmas()
    {
        $alarmas = Alarma::join('rutas', 'alarmas.id_ruta', 'rutas.id')
            ->select('alarmas.id', 'alarmas.radio', 'alarmas.estado', 'rutas.nombre as ruta', 'alarmas.latitud',
            'alarmas.longitud')
            ->where('id_cliente', auth()->user()->id)
            ->orderBy('alarmas.id', 'DESC')->get();
        return response([
            'alarmas' => $alarmas
        ], 200);
    }

    public function getLastAlarma()
    {
        $alarma = Alarma::join('rutas', 'alarmas.id_ruta', 'rutas.id')
            ->select('alarmas.*', 'rutas.nombre as ruta')
            ->where('id_cliente', auth()->user()->id)
            ->where('estado', 1)
            ->orderBy('alarmas.fechaHora', 'DESC')->first();
        return response([
            'alarma' => $alarma
        ], 200);
    }
}
