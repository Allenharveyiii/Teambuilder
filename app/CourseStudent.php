<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['studentID', 'coursesID'];
}