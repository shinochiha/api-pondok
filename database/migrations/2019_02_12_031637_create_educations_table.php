<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profile_id')->nullable();
            $table->uuid('uuid');
            $table->string('pre_elementary');
            $table->string('elementary');
            $table->string('junior_high');
            $table->string('senior_high');
            $table->string('other_education');
            $table->string('latest_major');
            $table->timestamps();
            $table->softDeletes();
            # foreign key
            $table->foreign('profile_id')
                  ->references('id')
                  ->on('profiles')
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
        Schema::dropIfExists('educations');
    }
}
