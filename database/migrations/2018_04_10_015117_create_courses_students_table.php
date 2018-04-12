<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentID')->unsigned();
            $table->foreign('studentID')->references('id')->on('users');
            $table->integer('courseID')->unsigned();
            $table->foreign('courseID')->references('id')->on('courses');

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
        Schema::dropIfExists('courses_students');
    }
}
