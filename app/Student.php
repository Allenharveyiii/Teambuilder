<?php

namespace App;

use App\User;
use App\Course;
use App\CourseStudent;
use App\Instructor;
use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function get_courses() {
        $course_students = CourseStudent::get()->where('studentID', $this->id);
        foreach ($course_students as $cs)
            $courses[] = $cs->get_course();
        return $courses;
    }

    public function get_instructor(Course $course) {
        return $course->get_instructor();
    }

    public function get_instructors() {
        $courses = $this->get_courses();
        $instructors = [];
        foreach ($courses as $course)
            $instructors[] = $course->get_instructor();
        return $instructors;
    }

    public function data_to_array() {
        switch ($this->concentration) {
            case 'CS':
                //TODO
                break;
            case 'IS':
                //TODO
                break;
            case 'IT':
                //TODO
                break;
            default:
                //TODO
                break;
        }
        $data = [$this->gpa, $this->concentration, $this->schedule];
        return $data;
    }
}
