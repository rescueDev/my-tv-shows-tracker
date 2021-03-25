@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="mx-auto row">
            <div class="mt-3 col-sm-12  d-flex flex-wrap justify-content-evenly">
                @foreach ($shows as $show)
                    <div class="mr-3 mt-3 mb-3">
                        <img src="{{ 'https://image.tmdb.org/t/p/w185' . $show->poster }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
