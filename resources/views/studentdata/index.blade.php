@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>studentdata</h3></div>
                    <div class="panel-heading">Page {{ $studentdata->currentPage() }} of {{ $studentdata->lastPage() }}</div>
                    @foreach ($studentdata as $post)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('studentdata.show', $post->id ) }}"><b>{{ $post->title }}</b><br>
                                   <?php
                                   
                                   if (strpos($post->body, 'student') !== false) {
                                    echo 'true';
                                    }
                                    ?>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $studentdata->links() !!}
                    </div>
                </div>
            </div>
        </div>


        
@endsection






