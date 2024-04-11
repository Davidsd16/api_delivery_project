<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstablismentsController;


Route::get('/establishments', [EstablismentsController::class, 'index']);
/*
// Define una ruta para crear órdenes
Route::middleware('auth:sanctum')->post('orders', function (){
    // Aborta la solicitud a menos que el usuario autenticado tenga permisos para crear órdenes
    abort_unless( Auth::user()->tokenCan('orders:create'), 403, "You dont't have premissions to perform this action.");
    // Devuelve un mensaje de éxito si se creó la orden
    return [
        'message' => 'Order created',
    ];
});
*/
// Definición de ruta para el inicio de sesión
Route::post('login', [LoginController::class, 'login']);

// Ruta protegida que requiere autenticación de Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Devuelve el usuario autenticado actualmente
    return Auth::user();
    
    // También se puede devolver el usuario a través del objeto Request
    // return $request->user();
});
