<?php

namespace App\Http\Controllers;
use App\Http\Controllers\kmeans;
use Illuminate\Http\Request;
use App\Course;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentDataController;

class ClustersController extends Controller
{
    public function get_teams(int $k_teams, int $courseID)
    {
        $course   = Course::get()->where('id', $courseID);
        $students = $course->get_students();
        $data     = [];
        foreach ($students as $student)
            $data[] = $student->data_to_array();
        $kmns  = new kmeans($k_teams, $data);
        $teams = $kmns->run();
        return view('/clusters', compact('k_teams','students', 'teams'));
    }
}
