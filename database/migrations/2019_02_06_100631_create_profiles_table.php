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
            $table->unsignedInteger('user_id')->nullable();
            $table->uuid('uuid');
            $table->string('fullname');
            $table->enum('gender', ['male', 'female']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('phone');
            $table->string('wa');
            $table->string('fb');
            $table->string('hobby');
            $table->string('dream');
            $table->string('idol');
            $table->string('quran');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
            # foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
