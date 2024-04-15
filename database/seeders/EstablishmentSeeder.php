<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Establishment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

/**
 * Clase Seeder para poblar la tabla establishments con datos falsos.
 */
class EstablishmentSeeder extends Seeder
{
    /**
     * Ejecuta los seeds en la base de datos.
     */
    public function run()
    {
        // Utiliza la fábrica Establishment para crear 50 registros ficticios
        Establishment::factory()
            ->count(50)
            ->create()
            ->each(function ($establishment) {
                // Asocia a cada establecimiento 5 productos ficticios
                $establishment->products()->saveMany(Product::factory()->count(5)->make());
            });
    }
}

