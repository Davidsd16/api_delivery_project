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

        Cart::restore('name');

        // Agregar el producto al carrito de compras con los detalles proporcionados
        Cart::add([
            'id' => $product->id, // Identificador único del producto
            'name' => $product->name, // Nombre del producto
            'qty' => request('qty'), // Cantidad del producto (obtenida de la solicitud HTTP)
            'price' => $product->price, // Precio del producto
            'weight' => 0, // Peso del producto (actualmente no utilizado)
        ]);

        Cart::store('name');

        return Cart::content();
    }

    /**
     * Muestra el contenido del carrito.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Restaura el carrito previamente almacenado bajo el nombre 'name'
        Cart::restore('name');

        // Almacena el contenido del carrito actual bajo el nombre 'name'
        Cart::store('name');

        // Devuelve el contenido actual del carrito
        return Cart::content();
    }

}
