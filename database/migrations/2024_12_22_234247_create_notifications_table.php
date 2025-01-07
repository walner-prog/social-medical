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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable'); // Relación polimórfica
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Añadir doctor_id si lo necesitas para filtrar notificaciones
            $table->foreignId('doctor_id')->nullable()->constrained()->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
