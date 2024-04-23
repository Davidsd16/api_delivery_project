<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart; // Importar la fachada Cart de la biblioteca de carrito de compras
use Gloudemans\Shoppingcart\CartItem; // Importar la clase CartItem

class OrdersController extends Controller
{
    public function store()
    {
        // Restaura el carrito previamente almacenado bajo el nombre 'name'
        Cart::restore('name');

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
           // 'user_id' => Auth::id(),
            'content' => $contentArray,
        ]);

        return $order;
    }
}
