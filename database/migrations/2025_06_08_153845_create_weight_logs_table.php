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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->decimal('weight', 5, 2);
            $table->timestamps();

            $table->unique(['user_id', 'date']); // agar tidak double input untuk tanggal yang sama
        });
    }

    public function down()
    {
        Schema::dropIfExists('weight_logs');
    }
}
