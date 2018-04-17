<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Instructor;
use App\CourseStudent;
use App\Student;

class Course extends Model
{
    protected $fillable = ['name', 'CRN','FacultyID',];
    protected $hidden = [];

    /// COURSE RELATIONSHIPS
    public function course_student() {
        return $this->belongsTo(CourseStudent::class);
    }

    public function instructor() {
        return $this->hasOne(Instructor::class);
    }

    /// COURSE ACCESSORS
    public function get_course_students() {
        return CourseStudent::get()->where('courseID', $this->CRN);
    }

    public function get_instructor() {
        return Instructor::get()->where('id', $this->FacultyID);
    }

    public function get_students() {
        $course_students = CourseStudent::get()->where('courseID', $this->id);
        return $course_students->get_students();
    }
}
