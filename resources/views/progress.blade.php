@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="mx-auto row">
            <div class="mt-3 col-sm-12  d-flex flex-wrap justify-content-evenly">
                @foreach ($shows as $show)
                    <div class="mr-3 mt-3 mb-3">
                        <a href="{{route('show-serie', $show->id)}}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w185' . $show->poster }}" alt="">
                        </a>
                        <form action="{{route('delete-show', $show->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{route('watched-show', $show->id)}}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-warning">Watched</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
