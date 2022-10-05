<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// Admin
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AgenciaController;
use App\Http\Controllers\Admin\DestinosController;
use App\Http\Controllers\Admin\CircuitosAdminController;
use App\Http\Controllers\Admin\CircuitosHotelesController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\ProveedoresController;
// Agencias
use App\Http\Controllers\Agencias\HotelesController;
use App\Http\Controllers\Agencias\CircuitosController;
/*



*/
// Ruta de Acceso / Principal
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

/* Acceso Agencias de Viajes*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //Hoteles
    Route::prefix('hoteles')->group(function () {
      Route::get('/',[HotelesController::class, 'index']);
    });
    //Circuitos
    Route::prefix('circuitos')->group(function () {
      Route::get('/',[CircuitosController::class, 'index']);
      Route::get('/destino',function() {return view('agencias.circuitos.resultados');});
      Route::get('/getItems',[CircuitosController::class, 'getItems']); // get items of circuitos destinos
      //Route::get('/{circuitoid}/{tag}',function() {return view('agencias.circuitos.detalles');});
    });
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    // Users
    Route::prefix('admin/users')->group(function () {
      Route::get('/',[UsersController::class, 'index']);
      Route::post('/action',[UsersController::class, 'action']); // CRUD
    });
    // ejecutivos
    Route::prefix('ejecutivo/users')->group(function () {
      Route::get('/',[UsersController::class, 'indexEjecutivo']);
      Route::post('/action',[UsersController::class, 'actionEjec']); // CRUD
    });
    // Agencias
    Route::prefix('agencias')->group(function () {
      Route::get('/',[AgenciaController::class, 'indexAgencia']);
      Route::post('/action',[AgenciaController::class, 'actionAgencia']); // CRUD
      // Usuarios
      Route::post('/users/action',[AgenciaController::class, 'actionAgeUs']); // CRUD
    });
    //Circuitos
    Route::prefix('circuitos')->group(function () {
      Route::get('/',[CircuitosAdminController::class, 'index']);
      Route::post('/actionCT',[CircuitosAdminController::class, 'actionCT']);
      Route::post('/itinerario',[CircuitosAdminController::class, 'itinerario']);
      Route::post('/galeria',[CircuitosAdminController::class, 'galeria']);
      Route::post('/hoteles',[CircuitosAdminController::class, 'hoteles']);
      Route::post('/salidas',[CircuitosAdminController::class, 'salidas']);
      Route::post('/tarifas',[CircuitosAdminController::class, 'tarifas']);
    });
    //autocomplete hotele
    Route::post('/searcho',[CircuitosHotelesController::class, 'hotelesSearch'])->name('searcho');

    //Galeria de imagenes
    Route::post('/galeria',[GaleriaController::class, 'action']);
    //hoteles
   Route::prefix('circuitos/hoteles')->group(function (){
       Route::get('/',[CircuitosHotelesController::class, 'indexHo']);
       Route::post('/action',[CircuitosHotelesController::class, 'actionHo']); // CRUD destinos

   });
   // categorias servicio
   Route::prefix('circuitos/servicios')->group(function (){
     //categorias hoteles
     Route::get('/',[CircuitosHotelesController::class, 'indexHoCat']);
     Route::post('/action',[CircuitosHotelesController::class, 'actionHoCat']); // CRUD destinos
   });
    // Get destinos (autocomplete)
    Route::post('/search',[DestinosController::class, 'destSearch'])->name('search');
    //Destinos
    Route::prefix('destinos')->group(function (){
        Route::get('/',[DestinosController::class, 'indexDest']);
        Route::post('/action',[DestinosController::class, 'actionDest']); // CRUD destinos
        Route::get('/paises',[DestinosController::class, 'indexDP']);
        Route::post('/paises/action',[DestinosController::class, 'actionDP']); // CRUD estados
        Route::get('/estados',[DestinosController::class, 'indexDE']);
        Route::post('/estados/action',[DestinosController::class, 'actionDE']); // CRUD estados
    });
    Route::prefix('circuitos/proveedores')->group(function(){
        Route::get('/',[ProveedoresController::class, 'indexProv']);
        Route::post('/action',[ProveedoresController::class, 'actionProv']);
    });
    //autocomplete estados
    Route::get('/searchp',[DestinosController::class, 'paisesSearch'])->name('searchp');
});
