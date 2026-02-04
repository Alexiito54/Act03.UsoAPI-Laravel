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
        //Creamos Tabla para los dueños
        Schema::create('duenos', function (Blueprint $table) {
        $table->id('id_persona');
        $table->string('nombre', 25);
        $table->string('apellido', 50);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
