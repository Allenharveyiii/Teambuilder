@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')

@role('Professor') {{-- Laravel-permission blade helper --}}

    <h1 align="center">

    this is where PROFESSORS can create a class students should not access this
</h1>
                                        
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Post</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(
            array(
                'route' => 'studentdata.store',
                'files' => true
                )) }}

        <div class="form-group">
            {{ Form::label('title', 'Section') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('body', 'Upload class list') }}

            
            {{ Form::file('body', null, array('class' => 'form-control')) }}

            <br>


            {{ Form::submit('Create Class', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

    @endrole

    @role('Student') {{-- Laravel-permission blade helper --}}
    u can not create a class 
    @endrole

@endsection