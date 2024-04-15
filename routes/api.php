<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\EstablismentsController;



// Ruta para el inicio de sesión
Route::post('login', [LoginController::class, 'login']);

// Ruta para obtener la lista de establecimientos
Route::get('/establishments', [EstablismentsController::class, 'index']);

// Define una ruta para mostrar un establecimiento específico.
Route::get('establishments/{id}', [EstablismentsController::class, 'show']);

Route::get('products/{product}', [ProductsController::class, 'show'])->name('products:show');

// Ruta para obtener los detalles del usuario autenticado
Route::get('/user', function (Request $request) {
    return Auth::user();
});

// Ruta para crear órdenes
Route::post('orders', function (){
    // Aborta la solicitud a menos que el usuario autenticado tenga permisos para crear órdenes
    abort_unless( Auth::user()->tokenCan('orders:create'), 403, "You don't have permissions to perform this action.");
    // Devuelve un mensaje de éxito si se creó la orden
    return [
        'message' => 'Order created',
    ];
});


