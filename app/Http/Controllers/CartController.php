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

    /**
     * Actualiza la cantidad de un producto en el carrito.
     *
     * @param  string $rowId El identificador único de fila del producto en el carrito.
     * @return \Illuminate\Support\Collection
     */
    public function update($rowId)
    {
        // Restaura el carrito previamente almacenado bajo el nombre 'name'
        Cart::restore('name');

        // Actualiza la cantidad del producto en el carrito
        Cart::update($rowId, [
            'qty' => request('qty')
        ]);

        // Almacena el contenido del carrito actual bajo el nombre 'name'
        Cart::store('name');

        // Devuelve el contenido actualizado del carrito
        return Cart::content();
    }

    /**
     * Elimina un producto del carrito.
     *
     * @param  string  $rowId El ID de fila del producto a eliminar.
     * @return \Illuminate\Support\Collection
     */
    public function destroy($rowId)
    {
        // Restaura el carrito previamente almacenado bajo el nombre 'name'
        Cart::restore('name');

        // Elimina el producto del carrito
        Cart::remove($rowId);
        
        // Almacena el contenido del carrito actual bajo el nombre 'name'
        Cart::store('name');

        // Devuelve el contenido actualizado del carrito
        return Cart::content();
    }

}
