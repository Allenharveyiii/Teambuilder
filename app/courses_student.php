<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courses_student extends Model
{
    protected $fillable = [
        'studentID', 'coursesID',
    ];

}
