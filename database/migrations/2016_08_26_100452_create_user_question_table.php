<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->integer('pid');
            $table->integer('qid');
            $table->integer('ans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_question');
    }
}
