<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\AgenciesController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\AutoPartsController;
use App\Http\Controllers\DamageTypesController;
use App\Http\Controllers\FuelTanksController;
use App\Http\Controllers\InspectionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CarsController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\RentalAgent;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['prefix' => 'cars'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('list', [CarsController::class, 'list']);
        Route::get('search', [CarsController::class, 'search']);
        Route::get('details', [CarsController::class, 'getDetails']);
        Route::get('types', [CarsController::class, 'getTypes']);
    });
});

Route::group(['prefix' => 'contracts'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('list', [ContractsController::class, 'list']);
        Route::get('search', [ContractsController::class, 'search']);
        Route::get('details', [ContractsController::class, 'getDetails']);
        Route::get('types', [ContractsController::class, 'getTypes']);
    });
});

Route::group(['prefix' => 'agencies'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('list', [AgenciesController::class, 'list']);
    });
});

Route::group(['prefix' => 'inspections'], function () {
    Route::get('print', [InspectionsController::class,'print']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('add', [InspectionsController::class, 'create']);
        Route::get('list', [InspectionsController::class, 'list']);
        Route::get('details', [InspectionsController::class, 'getById']);
        Route::post('close', [InspectionsController::class, 'close']);

    });

});


Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('list', [UsersController::class, 'list']);
    });
});

Route::group(['prefix' => 'accessories'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('list', [AccessoriesController::class, 'list']);
        Route::post('add', [AccessoriesController::class, 'create']);
        Route::put('update', [AccessoriesController::class, 'update']);
    });
});

Route::group(['prefix' => 'auto-parts'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('add', [AutoPartsController::class, 'create']);
        Route::get('list', [AutoPartsController::class, 'list']);
        Route::put('update', [AutoPartsController::class, 'update']);
    });
});

Route::group(['prefix' => 'fuel-tanks'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        //Route::post('add', [InspectionsController::class, 'create']);
        Route::get('list', [FuelTanksController::class, 'list']);
        //Route::get('details', [InspectionsController::class, 'getById']);
        //Route::post('close', [InspectionsController::class, 'close']);
    });
});

Route::group(['prefix' => 'damage-types'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('add', [DamageTypesController::class, 'createType']);
        Route::get('list', [DamageTypesController::class, 'listTypes']);
        Route::put('update', [DamageTypesController::class, 'updateType']);
    });
});
