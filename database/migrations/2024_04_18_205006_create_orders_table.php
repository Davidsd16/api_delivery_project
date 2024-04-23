<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Se utiliza una declaración de retorno para crear una migración anónima
// Esto es útil cuando no se desea crear una clase separada para una sola migración
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Se crea la tabla 'orders' en la base de datos
        Schema::create('orders', function (Blueprint $table) {

            // Se agrega una columna de identificación única autoincremental
            $table->id();
            
            // Se agrega una columna de clave externa que hace referencia a la tabla 'users'
            $table->foreignId('user_id');
    
            // Se agrega una columna para almacenar datos JSON
            $table->json('content');
    
            // Se agrega la marca de tiempo para la creación y actualización de registros
            $table->timestamps();

            // Se agrega una restricción de clave externa que hace referencia a la columna 'id' en la tabla 'users'
            // Se especifica que la acción 'cascade' se realizará tanto en actualizaciones como en eliminaciones
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Se elimina la tabla 'orders' si existe
        Schema::dropIfExists('orders');
    }
};
