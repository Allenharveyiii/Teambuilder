<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    //
    protected $fillable = [
        'name', 'CRN','FacultyID',
    ];
}
