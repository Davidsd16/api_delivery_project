<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Definición de ruta para el inicio de sesión
Route::post('login', [LoginController::class, 'login']);

// Ruta protegida que requiere autenticación de Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Devuelve el usuario autenticado actualmente
    return Auth::user();
    
    // También se puede devolver el usuario a través del objeto Request
    // return $request->user();
});
