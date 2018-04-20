<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'CRN','FacultyID',];
    protected $hidden = [];


    /// RELATIONSHIPS TO THE STUDENT MODEL( USES THE USER TABLE)
    public function students() {
        return $this->belongsToMany('App\Student','course_students','CourseID','studentID');
    }
    ///RELATIONSHIP TO THE INSTRUCTOR MODEL(USES THE USER TABLE)
    public function instructor(){
        return $this->belongsTo('App\Instructor','FacultyID');
    }


//


}
