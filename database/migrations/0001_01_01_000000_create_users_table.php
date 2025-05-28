<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('username');
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('name');
            $table->date('dob')->nullable()->after('gender');
            $table->integer('height')->nullable()->after('dob');
            $table->integer('weight')->nullable()->after('height');
            $table->text('about')->nullable()->after('weight');
            $table->string('photo')->nullable()->default('uploads/default.png')->after('about');
            $table->boolean('profile_completed')->default(false)->after('photo');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'gender',
                'dob',
                'height',
                'weight',
                'about',
                'photo',
                'profile_completed',
            ]);
        });
    }
}
