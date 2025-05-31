<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('trainer_id');
            $table->string('day');
            $table->date('date');
            $table->string('name');
            $table->string('kategori');
            $table->string('difficult');
            $table->string('reps');
            $table->string('videoUrl')->nullable();
            $table->timestamps();

            // Foreign keys (optional jika pakai user table)
            $table->foreign('trainee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}
