@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">

                <div class="card">

                    @if (Auth::user()->image)
                        <img class="card-img-top img-fluid" src="{{ asset('storage/icon/' . Auth::user()->image) }}"
                            alt="" height="400px" width="400px">
                    @else
                        <img class="card-img-top img-fluid" src="{{ asset('storage/icon/noimg.jpg') }}" alt=""
                            style="width: fit-content; height:400px">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">Your informations</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's
                            content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">email: {{ Auth::user()->email }}</li>
                        <li class="list-group-item">Name: {{ Auth::user()->name }}</li>
                        <li class="list-group-item">Lastname: {{ Auth::user()->lastname }}</li>
                        <li class="list-group-item">Join date: {{ Auth::user()->created_at }}</li>
                    </ul>
                    <div class="card-body">

                        <form action="{{ route('upload-avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <br>

                                <label for="icon">Upload your avatar</label>
                                <input type="file" name="icon" id="icon" class="d-block btn mb-3" placeholder="">

                                <br>
                                <input type="submit" class="btn btn-primary" value="Carica">

                                <a href="{{ route('clear-avatar') }}" class="btn btn-warning">Elimina</a>
                                <small id="helpId" class="text-muted"></small>
                            </div>
                        </form>


                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
