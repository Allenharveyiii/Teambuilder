<?php

namespace App;

use App\User;
use App\Student;
use App\Course;
use App\CourseStudent;
use Illuminate\Database\Eloquent\Model;

class Instructor extends User
{
    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function get_courses() {
        return Course::get()->where('instructorID', $this->id);
    }

    public function get_students(Course $course) {
        return $course->get_students();
    }
}
