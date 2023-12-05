<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Http\Requests\StoreCamionRequest;
use App\Http\Requests\UpdateCamionRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $camiones = Camion::all();
        return view('camiones.index', compact('camiones'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('camiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCamionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCamionRequest $request)
    {
        $camion =  Camion::create($request->validated());
        if ($request->hasFile('imagen')) {
            $camion->carpeta = $request->file('imagen')->store('imagenes/vehiculos', 's3');
            $camion->image = Storage::disk('s3')->url($camion->carpeta);
            $camion->save();
        }
        return redirect()->route('camiones.index')->with('message', 'Camión agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $camion = Camion::findOrFail($id);
        return view('camiones.show', compact('camion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $camion = Camion::findOrFail($id);
        return view('camiones.edit', compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCamionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCamionRequest $request, $id)
    {
        $camion = Camion::findOrFail($id);
        $camion->update($request->validated());
        if ($request->hasFile('image')) {
            Storage::disk('s3')->delete($camion->carpeta);
            $camion->carpeta = $request->file('image')->store('imagenes/vehiculos', 's3');
            $camion->image = Storage::disk('s3')->url($camion->carpeta);
            $camion->save();
        }
        return redirect()->route('camiones.index')->with('message', 'Los datos se han actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camion = Camion::findOrFail($id);
        try {
            $carpeta = $camion->carpeta;
            $camion->delete();
            Storage::disk('s3')->delete($carpeta);
            return redirect()->route('camiones.index')->with('message', 'Los datos se han borrado correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('camiones.index')->with('danger', 'Error al borrar los datos.');
        }
    }
}
