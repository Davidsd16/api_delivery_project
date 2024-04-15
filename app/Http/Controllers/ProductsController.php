<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Muestra un producto específico.
     *
     * @param  Product $product El producto a mostrar.
     * @return ProductResource   El recurso del producto.
     */
    public function show(Product $product)
    {
        try {
            // Intenta devolver el recurso del producto
            return new ProductResource($product);
        } catch (\Exception $e) {
            // Captura cualquier excepción que ocurra y devuelve un mensaje de error
            return response()->json(['error' => 'Hubo un problema al mostrar el producto.'], 500);
        }
    }
}
