<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\InspectionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CarsController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['prefix' => 'cars'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('list', [CarsController::class, 'listCars']);
        Route::get('search', [CarsController::class, 'searchCar']);
        Route::get('details', [CarsController::class, 'getCarDetails']);
        Route::post('types', 'CarsController@getTypes');
        Route::post('fuelTanks', 'CarsController@getFuelTanks');
    });
});
Route::group(['prefix' => 'agencies'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('list', 'AgenciesController@list');
    });
});

Route::group(['prefix' => 'inspections'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('add', [InspectionsController::class, 'crearInspeccion']);
        Route::get('list', [InspectionsController::class, 'listInspecciones']);
        Route::get('details', [InspectionsController::class, 'getInspeccionById']);
        Route::post('close', [InspectionsController::class, 'cerrarInspeccion']);
    });
});


Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('list', [UsersController::class, 'listUsers']);
    });
});

Route::group(['prefix' => 'accessories'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('list', [AccessoriesController::class, 'list']);
    });
});
