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
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['prefix' => 'vehiculos'], function(){
   Route::group(['middleware' => 'auth:api'], function(){
     Route::post('buscar', 'VehiculosController@buscarVehiculo');
     Route::post('getDetalle', 'VehiculosController@getDetalleVehiculo');
     Route::post('getTipos', 'VehiculosController@getTipos');
     Route::post('getTanques', 'VehiculosController@getTanquesComb');
   });
});

Route::group(['prefix' => 'agencias'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::post('listar', 'AgenciasController@listar');
    });
});

Route::group(['prefix' => 'inspecciones'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::post('crear', 'InspeccionesController@crearInspeccion');
    });
});

Route::group(['prefix' => 'usuarios'], function(){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('listar', 'UsuariosController@listarUsuarios');
    });
});

Route::group(['prefix' => 'accesorios'], function (){
    Route::group(['middleware' => 'auth:api'], function (){
        Route::post('listar', 'AccesoriosController@listar');
    });
});
