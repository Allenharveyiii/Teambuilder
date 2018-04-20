<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Instructor extends User
{
    public function courses() {
        return $this->belongsToMany('App/Course');
    }
}
