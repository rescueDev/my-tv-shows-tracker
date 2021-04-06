@extends('layouts.app')
@section('content')


    <div class="container-fluid">

        @if (!count($watched))
            <div class="col-12 mx-auto mt-5">

                <h1 class="text-center text-secondary mt-4">No watched shows!</h1>

            </div>

        @else


            <div class="mx-auto row mt-4">

                <h1 class="mx-auto text-secondary">Watched Shows</h1>

                <div class="mt-3 col-sm-12  d-flex flex-wrap justify-content-evenly">
                    @foreach ($watched as $show)
                        <div class="mr-3 mt-3 mb-3">
                            <a href="{{ route('show-watched-serie', $show->id) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w185' . $show->poster }}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        @endif
    </div>

@endsection
