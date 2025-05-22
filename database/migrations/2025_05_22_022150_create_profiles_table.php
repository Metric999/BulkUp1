<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // Relasi ke user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Kolom lengkap sesuai form
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->integer('age');
            $table->integer('height'); // cm
            $table->integer('weight'); // kg
            $table->string('goals')->nullable();
            $table->string('trainer')->nullable();
            $table->string('photo')->nullable(); // path foto profil

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
