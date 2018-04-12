<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\courses;
use Session;
use Auth;

class coursesController extends Controller
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
        $course = courses::orderby('name');
         return view('courses.index',compact('course'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this-> validate($request, [
      'name'=>'required',
      'CRN'=>'required|min:5|max:5',
      'FacultyID'=>'Required'
      ]);

      $name =$request['name'];
      $CRN =$request['CRN'];
      $FacID =$request['FacultyID'];

      $course = courses::create($request->only('name','CRN','FacultyID'));

      return redirect()->route('courses.index')
          ->with('flash_message','Courses '.$course->title.'created');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $course = courses::findorFail($id);

        return view('courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $course = courses::findOrFail($id);
        return view('courses.edit',compact('course'));
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
        $this-> validate($request, [
            'name'=>'required',
            'CRN'=>'required|min:5|max:5',
            'FacultyID'=>'Required'
        ]);

        $course =courses::findOrFail($id);
        $course->name = $request->input('name');
        $course->CRN = $request->input('CRN');
        $course->FacultyID = $request ->input('FacultyID');
        $course->save();

        return redirect()->route('courses.show',
            $course->id)->with('flash_message',
            'Courses, '. $course->name.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course =courses::findOrFail($id);
        $course->delete();

        return redirect()->route('posts.index')->
            with('flash_message', 'Courses successfully deleted');
    }

}
