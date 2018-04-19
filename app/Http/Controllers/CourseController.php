<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\CourseStudent;
use Session;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    public function index()
    {
        $course = Course::orderby('name')->paginate(10);
         return view('course.index',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'CRN' => 'required|min:5|max:5',
            'studentlist' => 'required'
        ]);

        $name = $request['name'];
        $CRN = $request['CRN'];
        $request['FacultyID'] = $request->user()->id;
        $course = course::create($request->only('name', 'CRN', 'FacultyID'));
        $studentlist = file_get_contents($request->file('studentlist'));
        $lines = explode('|', $studentlist);
        foreach ($lines as $line) {

            $column = explode(',', $line);
            $user = new User();

            $user->name = array_values($column)[0];
            $user->email = array_values($column)[1];
            $user->password = array_values($column)[2];
            $user->save();
            $user->assignRole(3);
            $enrollstudent = new CourseStudent();
            $enrollstudent->studentID = $user->id;
            $enrollstudent->courseID = $course->id;
            $enrollstudent->save();
        }
        unset($column);
        unset($line);

        return redirect()->route('course.index')
            ->with('flash_message', 'Courses ' . $course->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findorFail($id);
        return view('course.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this-> validate($request, ['name'=>'required', 'CRN'=>'required|min:5|max:5']);
        $course =Course::findOrFail($id);
        $course->name = $request->input('name');
        $course->CRN = $request->input('CRN');
        $course->save();
        return redirect()->route('course.show', $course->id)->with('flash_message', 'Courses, '. $course->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course =Course::findOrFail($id);
        $course->delete();
        return redirect()->route('posts.index')->with('flash_message', 'Courses successfully deleted');
    }
}
