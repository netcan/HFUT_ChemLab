<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->float('multi_score'); // 单选题分数
            $table->float('judge_score'); // 判断题分数
            $table->integer('time'); // 考试时间，秒
            $table->float('full_score'); // 满分
            $table->dateTimeTz('start_time'); // 开始时间
            $table->dateTimeTz('end_time'); // 结束时间
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
        Schema::drop('papers');
    }
}
