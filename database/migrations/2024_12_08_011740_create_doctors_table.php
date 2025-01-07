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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('specialty');
            $table->string('city');
            $table->integer('experience_years');
            
            // Detalles del doctor
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->json('availability')->nullable();
            
            // Nuevas columnas
            $table->string('certifications')->nullable();  // Certificaciones
            $table->string('education')->nullable();  // Educación
            $table->string('languages')->nullable();  // Idiomas
            $table->decimal('average_rating', 2, 1)->nullable();  // Promedio de calificación
            $table->integer('reviews_count')->nullable();  // Número de reseñas

            $table->string('consultation_hours')->nullable();  // Horario de consulta
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
