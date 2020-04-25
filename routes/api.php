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
     Route::get('list', 'VehiculosController@listVehiculos');
     Route::get('search', 'VehiculosController@searchVehiculo');
       Route::get('getData', 'VehiculosController@getVehiculoData');
   });
});

Route::group(['prefix' => 'usuarios'], function(){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('listar', 'UsuariosController@listarUsuarios');
    });
});
