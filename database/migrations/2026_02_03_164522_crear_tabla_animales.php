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
        //Tabla animales
        Schema::create('animales', function (Blueprint $table) {
            $table->id('id_animal');
            $table->string('nombre', 30);
            $table->enum('tipo', ['perro', 'gato', 'hámster', 'conejo']);
            $table->decimal('peso', 6, 2);
            $table->string('enfermedad', 50);
            $table->text('comentarios')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_persona');
            
            //Si se elimina dueño se eliminan sus animales
            $table->foreign('id_persona')
                 ->references('id_persona')->on('duenos')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
