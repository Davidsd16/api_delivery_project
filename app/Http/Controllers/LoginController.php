<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Business\AbilitiesResolver;

class LoginController extends Controller
{
    /**
     * Maneja la lógica de inicio de sesión.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        // Buscar el usuario en la base de datos utilizando su dirección de correo electrónico
        $user =  User::where('email', request('email'))->first();

        // Verificar si se encontró un usuario y si la contraseña proporcionada coincide
        if ($user && Hash::check(request('password'), $user->password)) {

            // Resolver las habilidades del usuario para el dispositivo dado
            $abilities = AbilitiesResolver::resolve($user, request('device'));
            
            // Crear un token de autenticación para el usuario con las habilidades resueltas
            $token = $user->createToken('login', $abilities);

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
