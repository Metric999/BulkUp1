<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('progress_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('workout_id')->nullable(); // Untuk workout
            $table->unsignedBigInteger('meal_id')->nullable();    // Untuk meal plan (optional)
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            // Relasi foreign key
            $table->foreign('trainee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meal_plans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress_submissions');
    }
}