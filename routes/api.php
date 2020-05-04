<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
    });
});

Route::group(['prefix' => 'vehiculos'], function(){
   Route::group(['middleware' => 'auth:api'], function(){
     Route::get('buscar', 'VehiculosController@buscarVehiculo');
     Route::get('getDetalle', 'VehiculosController@getDetalleVehiculo');
     Route::get('getTipos', 'VehiculosController@getTipos');
     Route::get('getTanques', 'VehiculosController@getTanquesComb');
   });
});

Route::group(['prefix' => 'agencias'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::get('listar', 'AgenciasController@listar');
    });
});

Route::group(['prefix' => 'inspecciones'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::post('agregar', 'InspeccionesController@crearInspeccion');
        Route::get('listar', 'InspeccionesController@listarInspecciones');
        Route::get('getById', 'InspeccionesController@getInspeccionById');
        Route::post('cerrar', 'InspeccionesController@cerrarInspeccion');
    });
});

Route::group(['prefix' => 'usuarios'], function(){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('listar', 'UsuariosController@listarUsuarios');
    });
});

Route::group(['prefix' => 'accesorios'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::get('listar', 'AccesoriosController@listar');
    });
});
