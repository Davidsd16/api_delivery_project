<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear la tabla 'products' en la base de datos
        Schema::create('products', function (Blueprint $table) {
            // Definir los campos de la tabla
            $table->id(); // Campo autoincremental para la clave primaria
            $table->string('name'); // Nombre del producto
            $table->integer('price'); // Precio del producto
            $table->text('details'); // Detalles del producto
            $table->foreignId('establishment_id'); // Clave foránea para la relación con el establecimiento
            $table->timestamps(); // Campos de fecha de creación y actualización
    
            // Definir la restricción de clave foránea para la relación con el establecimiento
            $table->foreign('establishment_id') // Utiliza foreign en lugar de foreignId
                ->references('id') // Hace referencia al campo 'id' de la tabla 'establishments'
                ->on('establishments') // Nombre correcto de la tabla 'establishments'
                ->onUpdate('cascade') // Actualizar en cascada si cambia el ID del establecimiento
                ->onDelete('cascade'); // Eliminar en cascada si se elimina el establecimiento
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
