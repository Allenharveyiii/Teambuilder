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

    public function course() {
        return $this->hasOne(Course::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function get_students() {
        return Student::get()->where('id', $this->studentID);
    }
}