<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstablishmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EstablismentsController extends Controller
{
    /**
     * Muestra una lista paginada de establecimientos, filtrados por categoría si se proporciona.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        try {
            $establishments =  Establishment::when(request()->filled('category'), function($query){
                $query->where('category', request('category'));
            })
            ->when(request()->exists('popular'), function($query){
                $query->orderBy('stars', 'DESC');
            })
            ->paginate(10);
        } catch (ModelNotFoundException) {
            // Devuelve un mensaje de error si la categoria del establecimiento no se encuentra
            return response()->json(['error' => 'La categoria selecciona no se encuentra disponible'], 404);
        }

        return EstablishmentResource::collection($establishments);
    }

    /**
     * Muestra el establecimiento correspondiente al ID proporcionado.
     *
     * @param  Establishment $id El establecimiento a mostrar.
     * @return \Illuminate\Http\Response|\Illuminate\Database\Eloquent\Model El establecimiento encontrado.
     */
    public function show($id)
    {
        try {
            // Busca el establecimiento por su ID
            $establecimiento = Establishment::findOrFail($id);
            
            // Devuelve el recurso
            return new EstablishmentResource($establecimiento);
        } catch (ModelNotFoundException) {
            // Devuelve un mensaje de error si el establecimiento no se encuentra
            return response()->json(['error' => 'El establecimiento no se pudo encontrar.'], 404);
        }
    }

}
