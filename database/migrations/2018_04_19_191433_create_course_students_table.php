<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentID')->unsigned();
            $table->foreign('studentID')->references('id')->on('users');
            $table->integer('courseID')->unsigned();
<<<<<<< HEAD:database/migrations/2018_04_10_015117_create_courses_students_table.php
            $table->foreign('courseID')->references('id')->on('course');
=======
            $table->foreign('courseID')->references('id')->on('courses');
>>>>>>> Clustering:database/migrations/2018_04_19_191433_create_course_students_table.php
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
        Schema::dropIfExists('course_students');
    }
}
