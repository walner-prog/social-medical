<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('plan_name', 50); // "Mensual", "Semestral", "Anual"
            $table->decimal('price', 10, 2);
            $table->dateTime('starts_at');
            $table->string('payer_email');
            $table->string('status');
            $table->json('payment_details');
            $table->string('payer_name', 100)->nullable();
            $table->string('billing_cycle', 20);
            $table->boolean('is_recurring')->default(false);
            $table->timestamp('renewed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->dateTime('ends_at');
            $table->timestamp('subscription_ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
