<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Fábrica para generar datos falsos para el modelo Establishment.
 * 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Establishment>
 */
class EstablishmentFactory extends Factory
{
    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Genera un nombre de empresa falso
            'name' => $this->faker->company(),
            // Genera una dirección falsa
            'address' => $this->faker->address(),
            // Genera un número de teléfono falso
            'phone' => $this->faker->phoneNumber(),
            // Genera una dirección de correo electrónico falsa
            'email' => $this->faker->safeEmail(),
            // Genera una ruta de logo falsa
            'logo' => 'logos/' . Str::random() . '.png',

            'category' => Arr::random(['fast food', 'chinese food']),

            'stars' => rand(100, 999),
        ];
    }
}
