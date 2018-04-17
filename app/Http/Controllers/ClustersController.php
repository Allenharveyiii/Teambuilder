<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use kmeans;
use App\Course;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentDataController;

class ClustersController extends Controller
{
    public function get_teams(Course $course)
    {
        $kmeans   = new kmeans(2, []);
        $clusters = $kmeans->get_clusters();
        return view("/clusters", compact("clusters"));
    }
}
