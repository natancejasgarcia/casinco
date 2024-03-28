<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Aquí definimos los cambios a aplicar, como añadir una columna de "money".
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('money')->default(0); // Añade la columna "money" con un valor por defecto de 0
        });
    }

    /**
     * Reverse the migrations.
     * Aquí definimos cómo revertir los cambios, como eliminar la columna "money".
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('money'); // Elimina la columna "money" si la migración se revierte
        });
    }
};
