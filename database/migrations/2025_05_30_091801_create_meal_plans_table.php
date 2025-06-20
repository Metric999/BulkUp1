<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('trainee_id'); // Ini akan menjadi foreign key ke trainee_profiles.id
            $table->date('date');
            $table->time('time');
            $table->string('type'); // Breakfast, Lunch, etc.
            $table->string('meal_name');
            $table->integer('calories');
            $table->text('note')->nullable();
            $table->timestamps();

            // Foreign key untuk trainer_id (tetap ke users.id)
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
            // Foreign key untuk trainee_id (BERUBAH: sekarang ke trainee_profiles.id)
            $table->foreign('trainee_id')->references('id')->on('trainee_profiles')->onDelete('cascade'); // <-- BERUBAH DI SINI
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meal_plans');
    }
};