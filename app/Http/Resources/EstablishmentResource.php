<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @return array<string, mixed>  // Indica que el tipo de retorno es un array con claves string y valores mixtos.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  // Obtiene el ID del establecimiento.
            'name' => $this->name,  // Obtiene el nombre del establecimiento.
            'address' => $this->address,  // Obtiene la dirección del establecimiento.
            'phone' => $this->phone,  // Obtiene el número de teléfono del establecimiento.
            'logo' => $this->logo,  // Obtiene el logo del establecimiento.
            'category' => $this->category,  // Obtiene la categoría del establecimiento.
            'stars' => $this->stars  // Obtiene la calificación del establecimiento.
        ];
    }
}
