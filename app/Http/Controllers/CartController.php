<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart; // Importar la fachada Cart de la biblioteca de carrito de compras
use Illuminate\Support\Facades\Auth; // Importar la fachada Auth para manejar la autenticación

class CartController extends Controller
{
    /**
     * Almacena un producto en el carrito de compras.
     *
     * @param  Product $product El producto a agregar al carrito.
     * @return void
     */
    public function store(Product $product)
    {
        // Agregar el producto al carrito de compras con los detalles proporcionados
        Cart::add([
            'id' => $product->id, // Identificador único del producto
            'name' => $product->name, // Nombre del producto
            'qty' => request('qty'), // Cantidad del producto (obtenida de la solicitud HTTP)
            'price' => $product->price, // Precio del producto
            'weight' => 0, // Peso del producto (actualmente no utilizado)
        ]);
        
        // Almacenar el contenido del carrito asociado al usuario actual por su correo electrónico
        Cart::store(Auth::user()->email);
    }
}
