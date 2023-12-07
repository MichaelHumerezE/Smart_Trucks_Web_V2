<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $TipoC = auth()->user()->tipoc;
            $TipoE = auth()->user()->tipoe;
            if ($TipoC == 1) {
                return view('inicio');
            } else {
                if ($TipoE == 1) {
                    $usuarios = User::get();
                    $recepciones = Recepcion::get();
                    $zonas = DB::select('select * from zonas_all');
                    $distritos = DB::select('select * from distritos_all');
                    $dias = DB::select('select * from kgs_dia_all');
                    $mes = DB::select('select * from kgs_mes_all');
                    $anual = DB::select('select * from kgs_anual_all');
                    $total = 0;

                    foreach ($distritos as $distrito) {
                        $total += $distrito->cantidad;
                    }
                    return view('home.index', compact('zonas', 'distritos', 'total', 'dias', 'mes', 'anual', 'usuarios', 'recepciones'));
                }
            }
        }
        /*if(auth()->user()){
            return view('home.index');
        }*/
        return view('inicio');
    }
}
