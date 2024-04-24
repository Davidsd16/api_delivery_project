<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryAvailabilityController extends Controller
{
    public function update()
    {
        /*
        // abort_unless( Auth::user()->tokenCan('orders:create'), 403, "You don't have permissions to perform this action.");
        */
        
        // Validar la solicitud entrante para asegurar que el campo 'status' esté presente y sea un booleano

        request()->validate([
            'status' => 'required|boolean',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener la configuración del usuario
        $config = $user->config;

        // Actualizar la disponibilidad en la configuración del usuario con el valor proporcionado en la solicitud
        $config['availability'] = request('status');

        // Asignar la configuración actualizada al usuario
        $user->config = $config;

        // Guardar los cambios en la base de datos
        $user->save();

        // Devolver el usuario actualizado con su nueva configuración de disponibilidad
        return $user;
    }
}
