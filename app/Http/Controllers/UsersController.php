<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo User

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // Obtén todos los usuarios
        $users = User::all();

        // Devuelve una respuesta con la información de los usuarios
        return response()->json($users, 200);
    }
}
