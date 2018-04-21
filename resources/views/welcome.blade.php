@extends('layouts.app')

@section('title', '| View Post')

@section('content')

    @role('Professor') {{-- Laravel-permission blade helper --}}
    <h1>Welcome, Professor</h1>

    @endrole

    @role('Student') {{-- Laravel-permission blade helper --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        function changeColor(x) {
            if(x.style.backgroundColor == ""){
                x.style.backgroundColor = "#E439A1";
            }else{
                x.style.backgroundColor = "";
            }
            var scheduleArray = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            if(document.getElementById("cell1").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[0] = 1;
                document.getElementsByName("cell1").value=1;
            }else{
                document.getElementsByName("cell1").value=0;
            }
            if(document.getElementById("cell2").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[1] = 1;
                document.getElementsByName("cell2").value=1;
            }else{
                document.getElementsByName("cell2").value=0;
            }
            if(document.getElementById("cell3").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[2] = 1;
                document.getElementsByName("cell3").value=1;
            }else{
                document.getElementsByName("cell3").value=0;
            }
            if(document.getElementById("cell4").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[3] = 1;
                document.getElementsByName("cell4").value=1;
            }else{
                document.getElementsByName("cell4").value=0;
            }
            if(document.getElementById("cell5").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[4] = 1;
                document.getElementsByName("cell5").value=1;
            }else{
                document.getElementsByName("cell5").value=0;
            }
            if(document.getElementById("cell6").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[5] = 1;
                document.getElementsByName("cell6").value=1;
            }else{
                document.getElementsByName("cell6").value=0;
            }
            if(document.getElementById("cell7").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[6] = 1;
                document.getElementsByName("cell7").value=1;
            }else{
                document.getElementsByName("cell7").value=0;
            }
            if(document.getElementById("cell8").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[7] = 1;
                document.getElementsByName("cell8").value=1;
            }else{
                document.getElementsByName("cell8").value=0;
            }
            if(document.getElementById("cell9").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[8] = 1;
                document.getElementsByName("cell9").value=1;
            }else{
                document.getElementsByName("cell9").value=0;
            }
            if(document.getElementById("cell10").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[9] = 1;
                document.getElementsByName("cell10").value=1;
            }else{
                document.getElementsByName("cell10").value=0;
            }
            if(document.getElementById("cell11").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[10] = 1;
                document.getElementsByName("cell1").value=1;
            }else{
                document.getElementsByName("cell1").value=0;
            }
            if(document.getElementById("cell12").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[11] = 1;
                document.getElementsByName("cell12").value=1;
            }else{
                document.getElementsByName("cell12").value=0;
            }
            if(document.getElementById("cell13").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[12] = 1;
                document.getElementsByName("cell13").value=1;
            }else{
                document.getElementsByName("cell13").value=0;
            }
            if(document.getElementById("cell14").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[13] = 1;
                document.getElementsByName("cell14").value=1;
            }else{
                document.getElementsByName("cell14").value=0;
            }
            if(document.getElementById("cell15").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[14] = 1;
                document.getElementsByName("cell15").value=1;
            }else{
                document.getElementsByName("cell15").value=0;
            }
            if(document.getElementById("cell16").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[15] = 1;
                document.getElementsByName("cell16").value=1;
            }else{
                document.getElementsByName("cell16").value=0;
            }
            if(document.getElementById("cell17").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[16] = 1;
                document.getElementsByName("cell17").value=1;
            }else{
                document.getElementsByName("cell17").value=0;
            }
            if(document.getElementById("cell18").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[17] = 1;
                document.getElementsByName("cell18").value=1;
            }else{
                document.getElementsByName("cell18").value=0;
            }
            if(document.getElementById("cell19").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[18] = 1;
                document.getElementsByName("cell19").value=1;
            }else{
                document.getElementsByName("cell19").value=0;
            }

            /*
            if(document.getElementById("cell20").style.backgroundColor === document.getElementById("fakediv").style.backgroundColor){
                scheduleArray[19] = 1;
                document.getElementsByName("cell20").value=1;
            }else{
                document.getElementsByName("cell20").value=0;
            }
            */
            console.log(scheduleArray);
            console.log(document.getElementsByName("cell20").value);
        }

        function submit(){
            document.getElementById("form").innerHTML='<h1 align="center">Thanks!</h1>';
        }

    </script>
    <style>
        .table th {
            text-align: center;
            background-color: #FF6F00;
            color: white;
        }
        .time {
            background-color: #00C851;
            color: white;
        }
    </style>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
    {{ Form::open(array('route' => 'studentdata.store','files' => true)) }}
    <div class="form-group">
        <br>
        <div id="fakediv" style="background-color:#E439A1"></div>
        <table class='table table-bordered table-striped' id="timeTable"> <thead>
            <tr>
                <th style="background-color:white" class="col-md-1">Time</th>
                <th class="col-md-1">Monday</th>
                <th class="col-md-1">Tuesday</th>
                <th class="col-md-1">Wednesday</th>
                <th class="col-md-1">Thursday</th>
                <th class="col-md-1">Friday</th>
            </tr>
            <tr>
                <td align="center" class="time">
                    8:00am-11:00am
                </td>
                <td id="cell1" onclick="changeColor(this)">
                    <input type="checkbox" name="cell1">
                </td>
                <td id="cell2" onclick="changeColor(this)">
                    <input type="checkbox" name="cell2" >
                </td>
                <td id="cell3" onclick="changeColor(this)">
                    <input type="checkbox" name="cell3" >
                </td>
                <td id="cell4" onclick="changeColor(this)">
                    <input type="checkbox" name="cell4" >
                </td>
                <td id="cell5" onclick="changeColor(this)">
                    <input type="checkbox" name="cell5" >
                </td>
            </tr>
            <tr>
                <td align="center" class="time">
                    11:00am-2:00pm
                </td>
                <td id="cell6" onclick="changeColor(this)">
                    <input type="checkbox" name="cell6" >
                </td>
                <td id="cell7" onclick="changeColor(this)">
                    <input type="checkbox" name="cell7" >
                </td>
                <td id="cell8" onclick="changeColor(this)">
                    <input type="checkbox" name="cell8" >
                </td>
                <td id="cell9" onclick="changeColor(this)">
                    <input type="checkbox" name="cell9" >
                </td>
                <td id="cell10"onclick="changeColor(this)">
                    <input type="checkbox" name="cell10" >
                </td>
            </tr>
            <tr>
                <td align="center" class="time">
                    2:00pm-5:00pm
                </td>
                <td id="cell11" onclick="changeColor(this)">
                    <input type="checkbox" name="cell11" >
                </td>
                <td id="cell12" onclick="changeColor(this)">
                    <input type="checkbox" name="cell12" >
                </td>
                <td id="cell13" onclick="changeColor(this)">
                    <input type="checkbox" name="cell13" >
                </td>
                <td id="cell14" onclick="changeColor(this)">
                    <input type="checkbox" name="cell14" >
                </td>
                <td id="cell15" onclick="changeColor(this)">
                    <input type="checkbox" name="cell15" >
                </td>
            </tr>
            <tr>
                <td align="center" class="time">
                    5:00pm-8:00pm
                </td>
                <td id="cell16" onclick="changeColor(this)">
                    <input type="checkbox" name="cell16" >
                </td>
                <td id="cell17" onclick="changeColor(this)">
                    <input type="checkbox" name="cell7" >
                </td>
                <td id="cell18" onclick="changeColor(this)">
                    <input type="checkbox" name="cell18" >
                </td>
                <td id="cell19" onclick="changeColor(this)">
                    <input type="checkbox" name="cell19" >
                </td>
                <td id="cell20" onclick="changeColor(this)">
                    <input type="checkbox" name="cell20" >
                </td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br>
        <div align="center">
            <h2 align="center">Concentration</h2>
            <label class="radio-inline"><input type="radio" name="isRadio">Information Systems</label>
            <label class="radio-inline"><input type="radio" name="itRadio">Information Technology</label>
            <label class="radio-inline"><input type="radio" name="csRadio">Computer Science</label>
        </div>
        <hr>
        <!--form align="center"class="form-inline"-->
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" class="form-control" name="gpa" placeholder="GPA">
            </div>
        <!--/form-->
        {{ Form::submit('upload student data', array('class' => 'btn btn-success btn-lg btn-block')) }}
        {{ Form::close() }}
    </div>
    <!--
<script type="text/javascript" src="{!! asset('js/studentForm.js') !!}"></script>
<div id='form'>
<h2 align="center">Select which times you're available</h2>
<div id="time">
<table class='table table-bordered table-striped' id="timeTable"> <thead>
                <tr>
                    <th style="background-color:white" class="col-md-1">Time</th>
                    <th class="col-md-1">Monday</th>
                    <th class="col-md-1">Tuesday</th>
                    <th class="col-md-1">Wednesday</th>
                    <th class="col-md-1">Thursday</th>
                    <th class="col-md-1">Friday</th>
                </tr>
                <tr>
                    <td align="center" class="time">
                        8:00am-11:00am
                    </td>
                    <td id="cell1" onclick="changeColor(this)">
                    </td>
                    <td id="cell2" onclick="changeColor(this)">
                    </td>
                    <td id="cell3" onclick="changeColor(this)">
                    </td>
                    <td id="cell4" onclick="changeColor(this)">
                    </td>
                    <td id="cell5" onclick="changeColor(this)">
                    </td>
                </tr>
                <tr>
                    <td align="center" class="time">
                    11:00am-2:00pm
                    </td>
                    <td id="cell6" onclick="changeColor(this)">
                    </td>
                    <td id="cell7" onclick="changeColor(this)">
                    </td>
                    <td id="cell8" onclick="changeColor(this)">
                    </td>
                    <td id="cell9" onclick="changeColor(this)">
                    </td>
                    <td id="cell10"onclick="changeColor(this)">
                    </td>
                </tr>
                <tr>
                    <td align="center" class="time">
                        2:00pm-5:00pm
                    </td>
                    <td id="cell11" onclick="changeColor(this)">
                    </td>
                    <td id="cell12" onclick="changeColor(this)">
                    </td>
                    <td id="cell13" onclick="changeColor(this)">
                    </td>
                    <td id="cell14" onclick="changeColor(this)">
                    </td>
                    <td id="cell15" onclick="changeColor(this)">
                    </td>
                </tr>
                <tr>
                    <td align="center" class="time">
                        5:00pm-8:00pm
                    </td>
                    <td id="cell16" onclick="changeColor(this)">
                    </td>
                    <td id="cell17" onclick="changeColor(this)">
                    </td>
                    <td id="cell18" onclick="changeColor(this)">
                    </td>
                    <td id="cell19" onclick="changeColor(this)">
                    </td>
                    <td id="cell20" onclick="changeColor(this)">
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>



<div align="center">
  <h2 align="center">Concentration</h2>
<label class="radio-inline"><input type="radio" name="optradio">Information Systems</label>
        <label class="radio-inline"><input type="radio" name="optradio">Information Technology</label>
        <label class="radio-inline"><input type="radio" name="optradio">Computer Science</label>
      </div>
        <hr>




  <form align="center"class="form-inline">

  <div class="form-group mx-sm-2 mb-2">

    <input type="text" class="form-control" id="inputPassword2" placeholder="GPA">
  </div>

</form>






 <div  class="col-xs-2 col-md-offset-5">
  <button onclick='submit()' type="button" class="btn btn-primary btn-block">Submit</button>
</div>
</div>
-->
    @endrole
@endsection
