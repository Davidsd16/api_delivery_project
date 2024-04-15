<?php

namespace Database\Factories;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Devuelve un arreglo con los atributos predeterminados del modelo
        return [
            'name' => $this->faker->words(3, true), // Nombre generado aleatoriamente
            'price' => rand(1000, 5000), // Precio generado aleatoriamente entre 1000 y 5000
            'details' => $this->faker->sentence(10), // Detalles generados aleatoriamente
            'establishment_id' => function () {
                // Crea una instancia de Establishment y devuelve su ID para establecer la relación
                return Establishment::factory()->create()->id;
            }
        ];
    }
}
