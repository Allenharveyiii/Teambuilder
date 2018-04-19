<?php

namespace App;

use App\User;
use App\Instructor;
use App\Student;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['studentID', 'coursesID',];
    protected $table = 'courses_students';

    public function course() {
        return $this->hasOne(Course::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function get_course() {
        return Course::get()->where('id', $this->courseID);
    }

    public function get_students() {
        return Student::get()->where('id', $this->studentID);
    }

    public function get_instructor() {
        $course = Course::get()->where('id', $this->courseID);
        return $course->get_instructor();
    }
}