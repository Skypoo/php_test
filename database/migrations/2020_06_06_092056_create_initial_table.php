<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('student_id');
            $table->string('student_name', 32);
            $table->string('email')->unique();
            $table->boolean('enable')->comment('1:開啟 0:關閉')->default(1);
            $table->timestamps();
        });

        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('teacher_name', 32);
            $table->string('email')->unique();
            $table->boolean('enable')->comment('1:開啟 0:關閉')->default(1);
            $table->timestamps();
        });

        Schema::create('class_info', function (Blueprint $table) {
            $table->increments('class_id');
            $table->string('class_name');
            $table->integer('teacher_id')->unsigned()->nullable();
            $table->time('class_time')->nullable();
            $table->tinyInteger('day')->unsigned()->nullable();
            $table->boolean('enable')->comment('1:開啟 0:關閉')->default(1);
            $table->timestamps();
        });
        Schema::table('class_info', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('teacher_id')->on('teacher');
        });

        Schema::create('class_member', function (Blueprint $table) {
            $table->integer('class_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->boolean('enable')->comment('1:開啟 0:關閉')->default(1);
        });

        Schema::table('class_member', function (Blueprint $table) {
            $table->primary(['class_id', 'student_id']);
            $table->index(['class_id', 'student_id']);
            $table->foreign('class_id')->references('class_id')->on('class_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_member', function (Blueprint $table) {
            $table->dropForeign('class_member_class_id_foreign');
            $table->dropIndex('class_member_class_id_student_id_index');
        });

        Schema::table('class_info', function (Blueprint $table) {
            $table->dropForeign('class_info_teacher_id_foreign');
        });

        Schema::dropIfExists('class_member');
        Schema::dropIfExists('class_info');
        Schema::dropIfExists('teacher');
        Schema::dropIfExists('student');
    }
}
