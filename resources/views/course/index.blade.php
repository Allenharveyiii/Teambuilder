@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Courses</h3></div>
                    <div class="panel-heading">Page {{ $course->currentPage() }} of {{ $course->lastPage() }}</div>
                    @foreach ($course as $line)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('course.show', $line->id ) }}"><b>{{ $line->name }}</b><br>
                                    <?php

                                    if (strpos($line->CRN, 'student') !== false) {
                                        echo 'true';
                                    }
                                    ?>
                                </a>
                            </li>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
    {!! $course->links() !!}
                </div>
            </div>
        </div>
    </div>



@endsection
