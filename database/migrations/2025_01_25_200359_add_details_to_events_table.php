<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToEventsTable extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('description')->nullable();  // Descripción del evento
            $table->string('location')->nullable();   // Ubicación del evento
            $table->string('hour')->nullable();       // Hora del evento
            $table->string('cost')->nullable();       // Costo del evento
            $table->string('audience')->nullable();   // Público objetivo del evento
            $table->string('registration')->nullable(); // Información sobre el registro
        });
    }

    /**
     * Revierte la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'location',
                'hour',
                'cost',
                'audience',
                'registration',
            ]);
        });
    }
}
