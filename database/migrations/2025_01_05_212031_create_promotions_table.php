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
    Schema::create('promotions', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->decimal('original_price', 8, 2);
        $table->decimal('discounted_price', 8, 2);
        $table->dateTime('start_date');
        $table->dateTime('end_date');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
