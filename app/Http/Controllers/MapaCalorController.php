<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapaCalorController extends Controller
{
    public function index()
    {
        $rutas = DB::select('select * from data_all');
        return view('mapasCalor.show', compact('rutas'));
    }

    public function store(Request $request)
    {
        $rutas = DB::select('call sp_dataQuery (?, ?)', array($request->fechaIni, $request->fechaFin));
        return view('mapasCalor.show', compact('rutas'));
    }
}
