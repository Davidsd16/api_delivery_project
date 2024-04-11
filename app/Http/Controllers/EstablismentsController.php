<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablismentsController extends Controller
{
    /**
     * Display a listing of the establishments.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {

        $establishments = (new Establishment)->newQuery();

        if (request()->filled('category')) {
            
            $establishments->where('category', request('category'));
        }
        return $establishments->paginate(10);
    }
}