<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profile_id')->nullable();
            $table->uuid('uuid');
            $table->enum('living_parent', ['0', '1', '2', '3', '4', '5']);
            $table->string('guardian');
            $table->string('parent_phone');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_job');
            $table->string('mother_job');
            $table->string('parent_income');
            $table->string('total_sibling');
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
        Schema::dropIfExists('families');
    }
}
