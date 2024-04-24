<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\EstablismentsController;

// Ruta para el inicio de sesión
Route::post('login', [LoginController::class, 'login']);

// Ruta para obtener la lista de establecimientos
Route::get('/establishments', [EstablismentsController::class, 'index']);

// Define una ruta para mostrar un establecimiento específico.
Route::get('establishments/{id}', [EstablismentsController::class, 'show']);

// Ruta para mostrar un producto específico.
Route::get('products/{product}', [ProductsController::class, 'show'])->name('products:show');

// Ruta para agregar un producto al carrito.
Route::post('cart/add-product/{product}', [CartController::class, 'store']);

// Ruta para obtener y mostrar el contenido del carrito
Route::get('cart', [CartController::class, 'index']);

// Ruta para actualizar un producto en el carrito mediante su identificador de fila
Route::put('cart/update/{rowId}', [CartController::class, 'update']);

// Ruta para eliminar un producto del carrito.
Route::delete('cart/delete/{rowId}', [CartController::class, 'destroy']);

// Ruta para obtener los detalles del usuario autenticado
Route::get('user', [UsersController::class, 'index']);


// Ruta para crear órdenes
Route::post('orders', [OrdersController::class, 'store']);

// Ruta para obtener órdenes del usuario actual
Route::get('orders', [OrdersController::class, 'index']);

// Ruta protegida para obtener información del usuario autenticado
Route::middleware('auth:sanctum')->get('/', function ($request) {
    return $request->user();
});

/*
    // Aborta la solicitud a menos que el usuario autenticado tenga permisos para crear órdenes
    abort_unless( Auth::user()->tokenCan('orders:create'), 403, "You don't have permissions to perform this action.");
    // Devuelve un mensaje de éxito si se creó la orden
    return [
        'message' => 'Order created',
    ];
*/



