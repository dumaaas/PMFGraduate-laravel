@extends('layout')
@section('movieList')

    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1> Movie list</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Home</a></li>
                            <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @guest
        <movie-index></movie-index>
    @endguest
    @auth
        <movie-index :moviestotal="{{$moviesTotal}}" :watchedcount="{{$watchedCount}}" :percent="{{$percent}}"></movie-index>
    @endauth

@endsection
