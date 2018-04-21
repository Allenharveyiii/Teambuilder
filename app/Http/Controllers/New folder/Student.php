<?php

namespace App;

use App\User;
use App\StudentData;
use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    public function courses() {
        return $this->BelongstoMany('App\Course','course_students','StudentID','courseID');
    }

    public function getStudentDataArray($id) {
        $studentData = StudentData::get()->where('title', $id);
        $data = [];
        $body = explode("#", $studentData[0]["body"]);
        for ($i = 0; $i < strlen($body[0]); $i++)
            $data[] = $body[0][$i];
        switch ($body[1])
        {
            case "CS":
                $data[] = 0;
                break;
            case "IS":
                $data[] = 1;
                break;
            case "IT":
                $data[] = 2;
                break;
            default:
                $data[] = -1;
        }
        $data[] = $body[2];
        //foreach ($data as $d)
        //    echo $d;
        //die();
        return $data;
    }
}
