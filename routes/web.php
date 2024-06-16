<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\InspectionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail/', [InspectionsController::class,'testMail']);

