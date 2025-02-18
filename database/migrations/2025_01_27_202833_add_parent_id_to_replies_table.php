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
    Schema::table('replies', function (Blueprint $table) {
        $table->unsignedBigInteger('parent_id')->nullable()->after('thread_id')->index();
        $table->foreign('parent_id')->references('id')->on('replies')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('replies', function (Blueprint $table) {
        $table->dropForeign(['parent_id']);
        $table->dropColumn('parent_id');
    });
}

};
