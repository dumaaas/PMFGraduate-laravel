@extends('layout')
@section('showMovie')
    <movie-show :movie="{{$movie}}" :isinwatched="{{$movie->isInMovieList('watched') ? 'true' : 'false'}}" :isinfavorite="{{$movie->isInMovieList('favorite') ? 'true' : 'false'}}" :isincustom="{{$movie->isInMovieList('custom') ? 'true' : 'false'}}" :isinwatchlist="{{$movie->isInMovieList('watchlist') ? 'true' : 'false'}}"></movie-show>
@endsection
