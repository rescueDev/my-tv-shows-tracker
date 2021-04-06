@extends('layouts.app')
@section('content')

    <div class="container-fluid">

        @if (!count($shows))
            <div class="col-12 mx-auto mt-5">

                <h1 class="text-center text-secondary">No shows in progress, add some please!</h1>

            </div>

        @else


            <div class="mx-auto row">

                <h1 class="mx-auto text-secondary mt-4">Your progress</h1>

                <div class="mt-3 col-sm-12  d-flex flex-wrap justify-content-evenly">

                    @foreach ($shows as $show)
                        <div class="mr-3 mt-3 mb-3">
                            <a href="{{ route('show-serie', $show->id) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w185' . $show->poster }}" alt="">
                            </a>

                            <div class="d-flex justify-content-evenly">

                                <form class="mr-2" action="{{ route('delete-show', $show->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="{{ route('watched-show', $show->id) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-warning">Watched</button>
                                </form>


                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
