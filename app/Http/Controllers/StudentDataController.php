<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\StudentData;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;



class StudentDataController extends Controller {

    public function __construct() {
       $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {

        $studentdata = StudentData::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        
        return view('studentdata.index', compact('studentdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('studentdata.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 

    //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required|file:txt'
            //'body' =>'required|max:100'
            ]);

        $post = new StudentData;


        $post->title = $request->input('title');
        $post->body = file_get_contents($request->file('body'));
        $post->save();



       // $title = $request['title'];
        //$body = $request['body'];
        
        //$post = StudentData::create($request->only('title', 'body'));

        //$post = StudentData::create($request['title']);



    //Display a successful message upon save
        return redirect()->route('studentdata.index')
            ->with('flash_message', 'Class,
             '. $post->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = StudentData::findOrFail($id); //Find post of id = $id

        return view ('studentdata.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = StudentData::findOrFail($id);

        return view('studentdata.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required|file:txt'
        ]);

        $post = StudentData::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect()->route('studentdata.show', 
            $post->id)->with('flash_message', 
            'Article, '. $post->title.' updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = StudentData::findOrFail($id);
        $post->delete();

        return redirect()->route('studentdata.index')
            ->with('flash_message',
             'Article successfully deleted');

    }
}