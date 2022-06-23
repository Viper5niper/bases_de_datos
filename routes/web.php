<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AerolineasController;
use App\Http\Controllers\PasajerosController;
use App\Http\Controllers\UbicacionesController;
use App\Http\Controllers\AvionesController;
use App\Http\Controllers\VuelosController;
use App\Http\Controllers\BoletosController;
use App\Http\Controllers\EtlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('aerolinea.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/clientes', ClienteController::class);
Route::get('/searchcliente', [ClienteController::class, 'search'])->name('clientes.search')->middleware(['auth:sanctum', 'verified']);

Route::resource('/aerolinea', AerolineasController::class);
Route::resource('/pasajeros', PasajerosController::class);
Route::resource('/ubicacion', UbicacionesController::class);
Route::resource('/avion', AvionesController::class);
Route::resource('/vuelo', VuelosController::class);
Route::resource('/boleto', BoletosController::class);
//Route::resource('/etl', EtlController::class);
Route::get('/etl/datawarehouse', [EtlController::class, 'etl'])->name('etl.datawarehouse');
Route::get('/etl/etl_archivo', [EtlController::class, 'etl_base'])->name('etl.etl_base');