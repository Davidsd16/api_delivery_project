<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User; // Importa el modelo User
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; // Importar la fachada Cart de la biblioteca de carrito de compras
use Gloudemans\Shoppingcart\CartItem; // Importar la clase CartItem

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // Obtener el usuario actual
        $user = $request->user();

        // Verificar si el usuario existe
        if (!$user) {
            // Si el usuario no existe, devolver un error
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el ID de usuario
        $userId = $user->id;

        // Restaura el carrito previamente almacenado bajo el nombre 'name'
        Cart::restore($userId);

        $content = Cart::content()->map(function (CartItem $cartItem) {
            return [
                'name' => $cartItem->name,
                'price' => $cartItem->price,
                'qty' => $cartItem->qty,
                'tax_rate' => $cartItem->taxRate,
                'total' => $cartItem->total(),
            ];
        });

        // Convierte el contenido del carrito en una matriz
        $contentArray = $content->toArray();

        // Destruye el carrito después de almacenar su contenido
        Cart::destroy();

        // Crea una nueva orden y la guarda en la base de datos
        $order = Order::create([
            'user_id' => $userId, // Asigna el ID de usuario
            'content' => $contentArray,
        ]);

        return new OrderResource($order);
    }
}
