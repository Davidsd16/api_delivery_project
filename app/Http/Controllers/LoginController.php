<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(){
        // Buscar el usuario en la base de datos utilizando su dirección de correo electrónico
        $user =  User::where('email', request('email'))->first();

        // Verificar si se encontró un usuario y si la contraseña proporcionada coincide
        if ($user && Hash::check(request('password'), $user->password)) {
            // Generar un token de autenticación para el usuario
            $token = $user->createToken('login');

            // Devolver el token en formato JSON como respuesta
            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }

        // Si las credenciales son inválidas, devolver un mensaje de error y un código de estado 401 (Unauthorized)
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

}
