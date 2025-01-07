<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relacionado con el usuario
            $table->timestamps();
        });

        // Crear la tabla intermedia para la relación muchos a muchos
        Schema::create('album_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->foreignId('image_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('album_image');
        Schema::dropIfExists('albums');
    }
}
