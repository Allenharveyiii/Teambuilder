@extends('layouts.app')

@section('title', '| View Post')

@section('content')

@role('Professor') {{-- Laravel-permission blade helper --}}

<div class="container">

    <h1 align="center">
    this is where you will be able to remove students from a class
</h1>

    <h1>{{ $post->title }}</h1>
    <hr>
    <p class="lead">{{ $post->body }}


        
     </p>
     <?php
     
        $array = explode('|', $post->body);
       // echo array_values($array)[0];
        //echo array_values($array)[1];
        $array2 = explode(',', $array[0]);
         
        

        
        
        $user = new App\User();
        $user->name = array_values($array2)[0];
        $user->password = '123456';
        $user->email = array_values($array2)[1];
        $user->save();
        
        ?>
    <hr>







    {!! Form::open(['method' => 'DELETE', 'route' => ['studentdata.destroy', $post->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Post')
    <a href="{{ route('studentdata.edit', $post->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Post')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endrole

@role('Student') {{-- Laravel-permission blade helper --}}
<h1 align="center">
    this is where u will put in ur schedule and gpa and stuff
</h1>
    @endrole

@endsection