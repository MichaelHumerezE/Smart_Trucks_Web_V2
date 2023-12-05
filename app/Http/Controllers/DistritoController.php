<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use App\Http\Requests\StoreDistritoRequest;
use App\Http\Requests\UpdateDistritoRequest;
use App\Models\Zona;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = Distrito::all();
        return view('distritos.index', compact('distritos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zonas = Zona::get();
        return view('distritos.create', compact('zonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistritoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistritoRequest $request)
    {
        Distrito::create($request->validated());
        return redirect()->route('distritos.index')->with('message', 'distrito Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distrito = Distrito::where('id', '=', $id)->firstOrFail();
        $zonas = Zona::get();
        return view('distritos.show', compact('distrito', 'zonas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distrito = Distrito::where('id', '=', $id)->firstOrFail();
        $zonas = Zona::get();
        return view('distritos.edit', compact('distrito', 'zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistritoRequest  $request
     * @param  \App\Models\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistritoRequest $request, $id)
    {
        $distrito = Distrito::find($id);
        $distrito->update($request->validated());
        return redirect()->route('distritos.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distrito = Distrito::findOrFail($id);
        try{
            $distrito->delete();
            return redirect()->route('distritos.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('distritos.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
