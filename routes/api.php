<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ModuleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
// Rutas para el inicio de sesión y cierre de sesión
Route::post('/registro',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
//
Route::get('/rol', [RolController::class, 'index']);
Route::post('/crearole', [RolController::class, 'store']);
///
Route::get('/modulo', [ModuleController::class, 'indexmodule']);
Route::post('/crear_modulo', [ModuleController::class, 'create_module']);
///
Route::get('/submodulo', [ModuleController::class, 'indexsubmodulos']);
Route::post('/crear_submodulo', [ModuleController::class, 'create_submodule']);
