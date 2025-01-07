<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('activity'); // Descripción de la actividad
            $table->date('date'); // Fecha de la actividad
            $table->string('status'); // Estado de la actividad (Completado, En progreso, etc.)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
