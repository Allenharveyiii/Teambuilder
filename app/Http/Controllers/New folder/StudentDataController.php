<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\StudentData;
use Auth;
use App\User;

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
        $studentdata = StudentData::orderby('id', 'desc')->paginate(10); //show only 5 items at a time in descending order
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
        /*
        $this->validate($request, ['title'=>'required|max:100','body' =>'required|file:txt''body' =>'required|max:100']);
        */
        $schedule = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
        $cell20= $request->input('cell20');
        $cell19= $request->input('cell19');
        $cell18= $request->input('cell18');
        $cell17= $request->input('cell17');
        $cell16= $request->input('cell16');
        $cell15= $request->input('cell15');
        $cell14= $request->input('cell14');
        $cell13= $request->input('cell13');
        $cell12= $request->input('cell12');
        $cell11= $request->input('cell11');
        $cell10= $request->input('cell10');
        $cell9= $request->input('cell9');
        $cell8= $request->input('cell8');
        $cell7= $request->input('cell7');
        $cell6= $request->input('cell6');
        $cell5= $request->input('cell5');
        $cell4= $request->input('cell4');
        $cell3= $request->input('cell3');
        $cell2= $request->input('cell2');
        $cell1= $request->input('cell1');
        if($cell1 == 'on')
            $schedule[0]=1;
        else
            $schedule[0]=0;
        if($cell2 == 'on')
            $schedule[1]=1;
        else
            $schedule[1]=0;
        if($cell3 == 'on')
            $schedule[2]=1;
        else
            $schedule[2]=0;
        if($cell4 == 'on')
            $schedule[3]=1;
        else
            $schedule[3]=0;
        if($cell5 == 'on')
            $schedule[4]=1;
        else
            $schedule[4]=0;
        if($cell6 == 'on')
            $schedule[5]=1;
        else
            $schedule[5]=0;
        if($cell7 == 'on')
            $schedule[6]=1;
        else
            $schedule[6]=0;
        if($cell8 == 'on')
            $schedule[7]=1;
        else
            $schedule[7]=0;
        if($cell9 == 'on')
            $schedule[8]=1;
        else
            $schedule[8]=0;
        if($cell10 == 'on')
            $schedule[9]=1;
        else
            $schedule[9]=0;
        if($cell11 == 'on')
            $schedule[10]=1;
        else
            $schedule[10]=0;
        if($cell12 == 'on')
            $schedule[11]=1;
        else
            $schedule[11]=0;
        if($cell13 == 'on')
            $schedule[12]=1;
        else
            $schedule[12]=0;
        if($cell14 == 'on')
            $schedule[13]=1;
        else
            $schedule[13]=0;
        if($cell15 == 'on')
            $schedule[14]=1;
        else
            $schedule[14]=0;
        if($cell16 == 'on')
            $schedule[15]=1;
        else
            $schedule[15]=0;
        if($cell17 == 'on')
            $schedule[16]=1;
        else
            $schedule[16]=0;
        if($cell18 == 'on')
            $schedule[17]=1;
        else
            $schedule[17]=0;
        if($cell19 == 'on')
            $schedule[18]=1;
        else
            $schedule[18]=0;
        if($cell20 == 'on')
            $schedule[19]=1;
        else
            $schedule[19]=0;
        $scheduleString = implode("", $schedule);
        $concentration = '';
        $isCon = $request->input('isRadio');
        $itCon = $request->input('itRadio');
        $csCon = $request->input('csRadio');
        if($isCon == 'on')
            $concentration='IS';
        if($itCon == 'on')
            $concentration='IT';
        if($csCon == 'on')
            $concentration='CS';
        //echo $concentration;
        $gpa= $request->input('gpa');
        // echo $gpa;
        $studentdata = $scheduleString."#".$concentration."#".$gpa;
        echo $studentdata;
        $post = new StudentData;
        $post->title = \Auth::user()->id;
        $post->body = $studentdata;
        $post->save();
        //test post
        //$post = new StudentData;
        // $post->title = \Auth::user()->id;
        // $post->body = "3.2#1001011101110011100#CS";
        /*
        $post = new StudentData;
        $post->title = $request->input('title');
        $post->body = file_get_contents($request->file('body'));
        $post->save();
        $user = new User;
        $user->name = 'sam';
        $user->password = '123456';
        $user->email = 'cade3234er@c.com';
        $user->save();
        $user->assignRole(1); //Assigning role to user
        */

        /*
        $array = explode('|', $post->body);
        //echo array_values($array)[0];
        //echo array_values($array)[1];
        $array2 = explode(',', $array[0]);
        $user = new App\User;
        $user->name = array_values($array2)[0];
        $user->password = '123456';
        $user->email = array_values($array2)[1];
        $user->save();
        $array = explode('|', $post->body);
        //echo array_values($array)[0];
        //echo array_values($array)[1];
        $array2 = explode(',', $array[0]);
        $user = new App\User();
        $user->name = array_values($array2)[0];
        $user->password = '123456';
        $user->email = array_values($array2)[1];
        $user->save();
        */
        //Display a successful message upon save
        return redirect()->route('course.index')->with('flash_message', 'thanks!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = StudentData::findOrFail($id); //Find post of id = $id
        return view('studentdata.show',compact('post'));
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
