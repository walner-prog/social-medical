<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAwardsTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->string('award_name'); // Nombre del premio
            $table->string('awarding_institution'); // Institución que otorga el premio
            $table->year('year'); // Año de otorgamiento
            $table->text('description')->nullable(); // Descripción opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor_awards');
    }
}