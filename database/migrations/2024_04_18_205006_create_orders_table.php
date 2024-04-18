<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Define la columna 'user_id' como clave externa que hace referencia a la columna 'id' en la tabla 'users'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Agrega la columna 'content' para almacenar los detalles de la orden en formato JSON
            $table->json('content');
    
            // Agrega las marcas de tiempo 'created_at' y 'updated_at' para el seguimiento temporal de las órdenes
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
