@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="mx-auto row">
            <div class="mt-3 col-sm-12  d-flex flex-wrap justify-content-center">
                    <div class="mr-3 mt-3 mb-3">
                        <h2> <strong>{{$show->name}}</strong> in progress</h2>
                    </div>

                <div class="mr-3 mt-3 mb-3">
                    <ul>
                        <br>
                        @foreach($show->seasons as $season)
                        <li>{{$season->name}}</li>
                            <br>
                            @foreach($season->episodes as $episode)
                                <li>{{$episode->episode_number . ' - ' . $episode->name}}</li>
                            @endforeach
                            <br>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection
