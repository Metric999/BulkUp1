<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('trainee_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Relasi ke tabel users
            $table->string('gender');
            $table->integer('age');
            $table->integer('height'); // dalam cm
            $table->integer('weight'); // dalam kg
            $table->string('trainer')->nullable(); // Nama trainer
            $table->string('photo')->nullable(); // Nama file foto
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainee_profiles');
    }
}
