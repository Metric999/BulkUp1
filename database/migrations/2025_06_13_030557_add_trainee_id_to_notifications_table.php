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
    Schema::table('notifications', function (Blueprint $table) {
        $table->foreignId('trainee_id')->nullable()->constrained('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->dropForeign(['trainee_id']);
        $table->dropColumn('trainee_id');
    });
}

};
