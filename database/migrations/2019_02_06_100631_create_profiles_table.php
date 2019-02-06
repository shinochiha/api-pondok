<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('full_name');
            $table->string('birth_place');
            $table->date('birth_data');
            $table->text('address');
            $table->string('province');
            $table->string('city');
            $table->string('phone_wa');
            $table->string('hobby');
            $table->string('dream');
            $table->string('fb');
            $table->enum('gender', ['male', 'female']);
            $table->string('qur`an');
            $table->string('phone');
            $table->string('photo');
            $table->string('idol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
