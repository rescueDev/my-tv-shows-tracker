@extends('layouts.app')
@section('content')

    <discover :auth="{{ Auth::user()->id }}"></discover>

@endsection
