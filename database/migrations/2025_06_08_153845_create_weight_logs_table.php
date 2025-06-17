<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    public function up()
{
    Schema::create('weight_logs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('trainee_id');
        $table->float('weight');
        $table->float('height');
        $table->integer('age');
        $table->string('gender');
        $table->float('bmi_result');
        $table->string('bmi_category');
        $table->timestamps();

        $table->foreign('trainee_id')->references('id')->on('trainee_profiles')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::dropIfExists('weight_logs');
    }
}
