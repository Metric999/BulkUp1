<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

class CreateTraineeFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->unsignedBigInteger('trainee_id');
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->text('comment');
            $table->timestamps();

            // Jika ada relasi dengan tabel trainees
            $table->foreign('trainee_id')->references('id')->on('trainees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
