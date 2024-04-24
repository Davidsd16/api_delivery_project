<?php

namespace App\Business;

use App\Models\User;

class AbilitiesResolver {

    /**
     * Resuelve las habilidades del usuario según su rol y dispositivo.
     *
     * @param User $user El usuario para el que se resolverán las habilidades.
     * @param string $device El dispositivo para el que se resolverán las habilidades.
     * @return array Las habilidades resueltas para el usuario y el dispositivo.
     */
    public static function resolve(User $user, $device){

        // Verificar si el usuario es un cliente
        if ($user->role == 'client') {
            // Si es un cliente, resolver habilidades específicas para clientes
            return static::resolveForClient($device);
        }

        if ($user->role == 'delivery') {
            // Si es un cliente, resolver habilidades específicas para clientes
            return static::resolveForDelivery($device);
        }

        return [];

    }

    /**
     * Resuelve las habilidades específicas para un cliente según el dispositivo.
     *
     * @param string $device El dispositivo para el que se resolverán las habilidades.
     * @return array Las habilidades resueltas para el cliente y el dispositivo.
     */
    public static function resolveForClient($device){
        // Utilizar un operador 'match' para asignar habilidades según el dispositivo
        return match ($device) {
            'watch' => [
                'establishment:show',
            ],
            default => [
                'establishment:show',
                'orders:create',
            ]
        };
    }

    public static function resolveForDelivery($device){
        return[
            'availability:update',
                
        ];       
    }

}
