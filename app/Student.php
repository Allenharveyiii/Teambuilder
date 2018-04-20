<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends User
{


    public function courses() {
        return $this->BelongstoMany('App\Course','course_students','StudentID','courseID');
    }


    }

