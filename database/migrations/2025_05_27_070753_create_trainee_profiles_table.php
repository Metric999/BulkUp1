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

            // Relasi ke tabel users (user_id = pemilik akun trainee)
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Nama, jenis kelamin, umur, tinggi, berat
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->integer('age');
            $table->integer('height'); // dalam cm
            $table->integer('weight'); // dalam kg

            // Foto opsional
            $table->string('photo')->nullable();

            // Relasi ke trainer (juga dari tabel users)
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainee_profiles');
    }
}
