@extends('layouts.app')
@section('content')

<!--    --><?php //dd($show->where('name', 'Cobra Kai')) ?>


    <div class="container-fluid">
        <div class="mx-auto row">
            <div class="mt-3 col-sm-12 d-flex flex-wrap" style=" min-height: 300px">
                    <div class="poster-box col-6 mr-3 mt-3 mb-3" style="background-image: url('{{'https://image.tmdb.org/t/p/w342' . $show->poster}}');     background-size: cover">
                        <h2> <strong>{{$show->name}}</strong></h2>
                    </div>
            </div>
            <div class="">

            </div>
        </div>


   </div>

@endsection
