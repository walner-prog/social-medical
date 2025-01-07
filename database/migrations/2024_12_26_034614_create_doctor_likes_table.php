<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorLikesTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade'); // Relación con doctores
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor_likes');
    }
}
