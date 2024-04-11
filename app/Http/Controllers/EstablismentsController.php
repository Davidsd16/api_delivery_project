<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
