<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use kmeans;

class ClustersController extends Controller
{
    public function display()
    {
        $kmeans   = new kmeans(2, array([1, 2], [3, 4], [5, 6]));
        $clusters = $kmeans->get_clusters();
        return view("/clusters", compact("clusters"));
    }
}
