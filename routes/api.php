<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\AnimalController;

// Rutas para dueños
Route::apiResource('duenos', DuenoController::class);

// Rutas para animales
Route::apiResource('animales', AnimalController::class);
