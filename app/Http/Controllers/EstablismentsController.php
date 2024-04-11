<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablismentsController extends Controller
{
    /**
     * Muestra una lista paginada de establecimientos, filtrados por categoría si se proporciona.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Establishment::when(request()->filled('category'), function($query){
            $query->where('category', request('category'));
        })
        ->when(request()->exists('popular'), function($query){
            $query->orderBy('stars', 'DESC');
        })
        ->paginate(10);
    }

    /**
     * Muestra el establecimiento correspondiente al ID proporcionado.
     *
     * @param  Establishment $id El establecimiento a mostrar.
     * @return \Illuminate\Http\Response|\Illuminate\Database\Eloquent\Model El establecimiento encontrado.
     */
    public function show($id)
    {
        // Find the establishment by its ID
        $establishment = Establishment::findOrFail($id);
    
        // Return the resource
        return new EstablishmentResource($establishment);
    }

}
