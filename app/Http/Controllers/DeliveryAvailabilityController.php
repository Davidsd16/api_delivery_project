<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
        // Esto garantiza que la solicitud contenga el campo 'status' y que su valor sea un booleano válido
        request()->validate([
            'status' => 'required|boolean',
        ]);

        
        $user = Auth::user();

        // Actualizar la configuración del usuario con el nuevo estado de disponibilidad recibido en la solicitud
        $user->config = array_merge($user->config, [
            'availability' => (boolean) request('status'),
        ]);

        // Guardar los cambios en la base de datos
        $user->save();

        // Devolver el usuario actualizado con su nueva configuración de disponibilidad
        return new UserResource($user);
    }
}
