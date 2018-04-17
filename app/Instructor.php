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
}
