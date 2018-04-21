@extends('layouts.app')

@section('title', '| View Post')

@section('content')

    @role('Professor') {{-- Laravel-permission blade helper --}}
    <div class="container">
        <h1>{{ $course->name }}</h1>
        @foreach ($instructor as $line)
        <h5>{{$line->name }}</h5>
        @endforeach
        <hr>
        <h3 >Students Enrolled</h3>
        <div>
        <ul class="list-group">
        @foreach ($studentroster as $student)
                <li class="list-group-item">{{ $student->name }}</li>
        @endforeach
        </ul>
        <div  class="container">
        <!-- CLUSTERING WITH K-MEANS -->
        <form action="../clusters/{{$course->id}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="k_teams">Number of teams</label>
                <input id="k_teams" name="k_teams" type="text" class="form-control" placeholder="4" required autofocus/>
                <button type="submit" class="btn btn-primary">Build Teams</button>
            </div>
        </form>
    </div>
    {!! Form::open(['method' => 'DELETE', 'route' => ['course.destroy', $course->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Class')
        <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info" role="button">Edit Roster</a>
    @endcan
    @can('Delete Class')
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}
    @endrole

    @role('Student') {{-- Laravel-permission blade helper --}}
    <script type="text/javascript" src="{!! asset('js/studentForm.js') !!}"></script>
    <div id='form'>
        <h2 align="center">Select which times you're available</h2>
        <div id="time">
            <table class='table table-bordered table-striped' id="timeTable">
                <thead>
                <tr>
                    <th style="background-color:white" class="col-md-1">Time</th>
                    <th class="col-md-1">Monday</th>
                    <th class="col-md-1">Tuesday</th>
                    <th class="col-md-1">Wednesday</th>
                    <th class="col-md-1">Thursday</th>
                    <th class="col-md-1">Friday</th>
                </tr>
                <tr>
                    <td align="center" class="time">8:00am-11:00am</td>
                    <td id="cell1" onclick="changeColor(this)"></td>
                    <td id="cell2" onclick="changeColor(this)"></td>
                    <td id="cell3" onclick="changeColor(this)"></td>
                    <td id="cell4" onclick="changeColor(this)"></td>
                    <td id="cell5" onclick="changeColor(this)">
                    </td></tr>
                <tr>
                    <td align="center" class="time">11:00am-2:00pm</td>
                    <td id="cell6" onclick="changeColor(this)"></td>
                    <td id="cell7" onclick="changeColor(this)"></td>
                    <td id="cell8" onclick="changeColor(this)"></td>
                    <td id="cell9" onclick="changeColor(this)"></td>
                    <td id="cell10"onclick="changeColor(this)"></td>
                </tr>
                <tr>
                    <td align="center" class="time">2:00pm-5:00pm</td>
                    <td id="cell11" onclick="changeColor(this)"></td>
                    <td id="cell12" onclick="changeColor(this)"></td>
                    <td id="cell13" onclick="changeColor(this)"></td>
                    <td id="cell14" onclick="changeColor(this)"></td>
                    <td id="cell15" onclick="changeColor(this)"></td>
                </tr>
                <tr>
                    <td align="center" class="time">5:00pm-8:00pm</td>
                    <td id="cell16" onclick="changeColor(this)"></td>
                    <td id="cell17" onclick="changeColor(this)"></td>
                    <td id="cell18" onclick="changeColor(this)"></td>
                    <td id="cell19" onclick="changeColor(this)"></td>
                    <td id="cell20" onclick="changeColor(this)"></td>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div align="center">
                <h2 align="center">Concentration</h2>
                <label class="radio-inline">
                    <input type="radio" name="optradio">Information Systems</label>
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
    </div>
    @endrole
@endsection
