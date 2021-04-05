@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="mx-auto row">
            <div class="mt-3 col-sm-12 d-flex flex-wrap" style=" min-height: 300px">
                    <div class="poster-box col-12 mr-3 mt-3 mb-3" style="background-image: url('{{'https://image.tmdb.org/t/p/w780' . $show->backdrop_path}}'); background-size: cover; min-height: 400px">
                        <h2 class="show-title mt-2"> <strong>{{$show->name}}</strong></h2>
                    </div>
            </div>
        </div>


            <div class="mx-auto row">
                <ul class="col-12">
                    <br>
                    <?php $count = 0; ?>
                @foreach($show->seasons as $season)
                        <li class="mt-3" ><h4>{{$season->name}}</h4></li>
                        <br>
                        <ul class="col-sm-12 d-flex flex-wrap mr-1 justify-content-evenly  mt-3">


                            @foreach($season->episodes as $episode)
                                    <form class="episodes-box mb-2 mr-2 ml-2 mt-2" action="{{route('check-episode', $episode->id)}}" method="POST">
                                        @csrf
                                        @method('POST')


                                        <div class="ep-poster mb-2">
                                            <a class="cont-img-ep" href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $count; ?>">
                                                <img class="" src="{{'https://image.tmdb.org/t/p/w342' . $episode->image}}" alt="ep-poster">
                                            </a>
                                            <button class="watched-check btn btn-success mr-3" type="submit"><i class="far fa-check-square"></i></button>
                                        </div>
                                        <h5>{{$episode->episode_number . ' - ' . $episode->name}}</h5>





                                        <!-- Modal -->

                                        <div class="modal fade" id="exampleModalCenter<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-image: url('{{'https://image.tmdb.org/t/p/w342' . $episode->image}}'); background-size: cover; min-height: 200px">
                                                        <h3 class="modal-title mr-2 text-white p-1 rounded modal-s-e" id="exampleModalLongTitle">
                                                            {{'S' . $episode->season_number . '|' . 'E' . $episode->episode_number}}
                                                        </h3>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>
                                                    <div class="modal-header">
                                                        <h3 class="modal-title text-secondary" id="exampleModalLongTitle">{{$episode->name}}</h3>

                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-muted">{{$episode->first_air_date}}</p>
                                                       <p class="text-body"> {{$episode->overview}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{route('check-episode', $episode->id)}}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-primary">Mark As Watched</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                <?php $count++; ?>

                            @endforeach
                            <br>
                        </ul>
                        <?php $count++; ?>
                    @endforeach
                </ul>
            </div>
        </div>


@endsection