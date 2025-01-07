<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario que envió el mensaje
        $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Relación con la publicación
        $table->text('content'); // Contenido del mensaje
        $table->integer('rating')->nullable(); // Calificación del post
        $table->timestamps(); // Tiempos de creación y actualización
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
