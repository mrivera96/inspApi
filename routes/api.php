<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\AgenciesController;
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
        Route::get('types', [CarsController::class,'getTypes']);
    });
});
Route::group(['prefix' => 'agencies'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('list', [AgenciesController::class,'list']);
    });
});

Route::group(['prefix' => 'inspections'], function () {
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
    });
});
