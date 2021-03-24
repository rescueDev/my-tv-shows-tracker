@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex">
                @foreach ($shows as $show)
                    <div class="">
                        <img src="{{ 'https://image.tmdb.org/t/p/w185' . $show->poster }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
