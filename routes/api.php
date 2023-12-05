<?php

use App\Http\Controllers\API\AlarmaController;
use App\Http\Controllers\API\AuthChoferController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChoferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/registerC', [AuthController::class, 'register']);

Route::post('/loginC', [AuthController::class, 'login']);

Route::post('/login', [AuthChoferController::class, 'login']);

//Route::get('/getRuta/{id}', [AlarmaController::class, 'getRuta']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthChoferController::class, 'logout']);
    Route::get('/listaEmpleados', [ChoferController::class, 'listaEmpleados']);
    Route::get('/listarCamiones', [ChoferController::class, 'listarCamiones']);
    Route::post('/registrarEquipoDeRecorrido', [ChoferController::class, 'registrarEquipoDeRecorrido']);
    Route::get('/listarRutas', [ChoferController::class, 'listarRutas']);
    Route::post('/obtenerCoordenadaDeLaRuta', [ChoferController::class, 'obtenerCoordenadaDeLaRuta']);
    Route::post('/guardarRecorridoDelChofer', [ChoferController::class, 'guardarRecorridoDelChofer']);
    Route::get('/getChofer', [ChoferController::class, 'getChofer']);
    Route::post('/createAlarma', [AlarmaController::class, 'register']);
    Route::get('/getRutas', [AlarmaController::class, 'getRutas']);
    Route::get('/getRuta/{id_ruta}', [AlarmaController::class, 'getRuta']);
    Route::get('/getAlarmas', [AlarmaController::class, 'getAlarmas']);
    Route::get('/getLastAlarma', [AlarmaController::class, 'getLastAlarma']);
    Route::get('/getUser', [AuthController::class, 'getUser']);
});
