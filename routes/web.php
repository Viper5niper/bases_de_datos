<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\PagoController;
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
    return redirect()->route('ordenestrabajo.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/ordenestrabajo', OrdenTrabajoController::class);
Route::get('/ordenestrabajo/{ordenestrabajo}/print', [OrdenTrabajoController::class, 'print'])->name('ordenestrabajo.print');
Route::get('/ordenestrabajo/{ordenestrabajo}/printcotizacion', [OrdenTrabajoController::class, 'printcotizacion'])->name('ordenestrabajo.printcotizacion');
//Route::get('/printcotizacion', [OrdenTrabajoController::class, 'printcotizacion'])->name('ordenestrabajo.printcotizacion');
Route::post('/ordenestrabajocotizar', [OrdenTrabajoController::class, 'storeCotizacion'])->name('ordenestrabajo.cotizar');
Route::get('/ordenestrabajopay', [OrdenTrabajoController::class, 'pay'])->name('ordenestrabajo.pay');
Route::get('/ordenestrabajocontact', [OrdenTrabajoController::class, 'contact'])->name('ordenestrabajo.contact');
Route::get('/ordenestrabajocotizaciones', [OrdenTrabajoController::class, 'cotizaciones'])->name('ordenestrabajo.cotizaciones');
Route::get('/ordenestrabajo/{ordenestrabajo}/makecontact', [OrdenTrabajoController::class, 'makecontact'])->name('ordenestrabajo.makecontact');


Route::resource('/clientes', ClienteController::class);
Route::get('/searchcliente', [ClienteController::class, 'search'])->name('clientes.search')->middleware(['auth:sanctum', 'verified']);

Route::resource('/pagos', PagoController::class);