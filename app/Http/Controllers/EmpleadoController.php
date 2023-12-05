<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-empleado|crear-empleado|editar-empleado|borrar-empleado', ['only' => 'index']);
        $this->middleware('permission:ver-empleado', ['only' => 'show']);
        $this->middleware('permission:crear-empleado', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-empleado', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-empleado', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = User::where('tipoe', 1)->get();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $empRole = '';
        return view('empleados.create', compact('roles', 'empRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpleadoRequest $request)
    {
        //$this->validate($request, ['roles' => 'required']);
        $user = User::create($request->validated());
        $user->assignRole($request->input('roles'));
        if ($request->hasFile('image')) {
            $user->carpeta = $request->file('image')->store('imagenes/empleados', 's3');
            $user->image = Storage::disk('s3')->url($user->carpeta);
            $user->save();
        }
        return redirect()->route('empleados.index')->with('message', 'Empleado Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = User::where('id', '=', $id)->firstOrFail();
        $roles = Role::pluck('name', 'name')->all();
        $empRole = $empleado->roles->pluck('name', 'name')->all();
        return view('empleados.show', compact('empleado', 'roles', 'empRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = User::where('id', '=', $id)->firstOrFail();
        $roles = Role::pluck('name', 'name')->all();
        $empRole = $empleado->roles->pluck('name', 'name')->all();
        return view('empleados.edit', compact('empleado', 'roles', 'empRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoRequest $request, $id)
    {
        $this->validate($request, ['roles' => 'required']);
        $empleado = User::find($id);
        $antImg = $empleado->carpeta;
        $empleado->update($request->validated());
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $empleado->assignRole($request->input('roles'));
        if ($request->hasFile('image')) {
            Storage::disk('s3')->delete($empleado->carpeta);
            $empleado->carpeta = $request->file('image')->store('imagenes/empleados', 's3');
            $empleado->image = Storage::disk('s3')->url($empleado->carpeta);
            $empleado->save();
        }
        return redirect()->route('empleados.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = User::findOrFail($id);
        try {
            $carpeta = $empleado->carpeta;
            $empleado->delete();
            Storage::disk('s3')->delete($carpeta);
            return redirect()->route('empleados.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('empleados.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
