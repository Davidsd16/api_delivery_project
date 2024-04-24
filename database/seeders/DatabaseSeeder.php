<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

/**
 * Clase Seeder para poblar la base de datos de la aplicación.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Llena la base de datos de la aplicación.
     */
    public function run(): void
    {
        // Crea un usuario administrador predeterminado
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);


        User::factory()->create([
            'name' => 'Luis',
            'email' => 'luis@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'delivery',
            'config' => [
                'availability' => false
            ],
        ]);

        
        // Llama al seeder EstablishmentSeeder para poblar la tabla establishments
        $this->call(EstablishmentSeeder::class);
    }
}
