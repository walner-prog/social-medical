<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id'); // sera el usuario autenticado con roll patient
            $table->unsignedBigInteger('doctor_id');
            $table->string('title'); // Tipo de cita (Consulta, revisión, etc.)
           //  estos dos campos son importante ya que cada cita el medico podra elegir cuanto debe durar su servicio de la cita de manera que segun eso 
           // el medico tendra la opcion de configurar su cita ya sea media hora , una hora ,dos hora,tres hora, cuatro horas o 6 horas ejemplo para operaciones quirurgicas 
           $table->datetime('start')->nullable();
           $table->datetime('end')->nullable();

            $table->integer('duration')->nullable();
           
            $table->enum('status', ['pendiente', 'completada', 'cancelada'])->default('pendiente'); // Estado de la cita
            
            $table->timestamps();
    
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
