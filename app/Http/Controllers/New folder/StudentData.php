<?php

namespace App;

use App\Student;
use App\Instructor;
use App\User;
use Illuminate\Database\Eloquent\Model;

class StudentData extends Model
{
    protected $fillable = ['title', 'body'];

    public function dataToArray($title)
    {
        $data = [];
        $body = explode("#", $this->body);
        for ($i = 0; $i < sizeof($body[0]); $i++)
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
        print("StudentData: ".$data);
        return $data;
    }
}
