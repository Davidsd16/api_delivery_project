<?php

namespace Database\Seeders;

use App\Models\Establishment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Clase Seeder para poblar la tabla establishments con datos falsos.
 */
class EstablishmentSeeder extends Seeder
{
    /**
     * Ejecuta los seeds en la base de datos.
     */
    public function run(): void
    {
        // Utiliza la fábrica Establishment para crear 50 registros ficticios
        Establishment::factory()->count(50)->create();
    }
}
