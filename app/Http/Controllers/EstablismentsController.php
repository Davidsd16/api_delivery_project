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
        return Establishment::paginate(10);
    }
}