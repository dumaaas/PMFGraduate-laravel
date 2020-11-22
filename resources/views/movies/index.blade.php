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
    <div class="page-single movie_list">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <form method="GET" action="/sortMovies">
                        @csrf
                        <div class="topbar-filter">
                            <p>Found <span>{{ $moviesNum }}</span> movies in total</p>
                            <label>Sort by:</label>
                            <select name='sort'>
                                <option value="ratingHighest">From highest rating</option>
                                <option value="ratingLowest">From lowest rating</option>
                                <option value="newest">From newest</option>
                                <option value="oldest">From oldest</option>
                                <option value="favoriteMost">Most favorite</option>
                                <option value="favoriteLeast">Least favorite</option>
                                <option value="watchedMost">Most watched</option>
                                <option value="watchedLeast">Least watched</option>
                                <option value="commentsMost">Most comments</option>
                                <option value="commentsLeast">Least comments</option>
                                <option value="watched">You watched</option>


                            </select>

                            <button>SORT</button>

                        </div>
                    </form>

                    @foreach ($movies as $movie)
                        <div class="movie-item-style-2">
                            <img src="/images/movies/{{ $movie->avatar }}" alt="" width="60px">
                            <div class="mv-item-infor">
                                <h6><a href="/movies/{{ $movie->id }}">{{ $movie->name }}
                                        <span>{{ $movie->releaseYear }}</span></a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span>{{ $movie->imdb }}</span> /10</p>
                                <p class="describe">{{ $movie->description }}</p>
                                <p class="run-time"> Duration: {{ $movie->duration }} min</p>
                                {{-- <p>Director: <a href="#">Joss Whedon</a></p>
                                --}}

                                <p>Stars:
                                    @foreach ($movie->acting()->latest()->take(3)->get() as $acting)
                                        <a href="/cast/{{ $acting->cast->id }}">{{ $acting->cast->firstName }}
                                            {{ $acting->cast->lastName }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p class="run-time"> Genre: {{ $movie->genre }}</p>

                            </div>
                        </div>
                    @endforeach
                    {{-- {{ $movies->links() }} --}}
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="celebrities">
                            @auth
                                <h4 class="form-style-1 sb-title">You watched <span>{{ $watchedCount }}/{{ $moviesTotal }}
                                        ({{ $percent }}%)</span></h4>
                            @endauth

                            {{-- <div class="celeb-item">
                                <a href="#"><img src="/images/actors/{{ $mf->avatar }}" alt="" width="70px"></a>
                                <div class="celeb-author">
                                    <h6><a href="/cast/{{ $mf->id }}">{{ $mf->firstName }} {{ $mf->lastName }}</a></h6>
                                    <span>{{ $mf->occupation }}</span>
                                </div>
                            </div> --}}

                        </div>
                        <div class="searh-form">
                            <h4 class="sb-title">Search for movie</h4>
                            <form class="form-style-1" action="/searchMovies" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label>Movie name</label>
                                        <input name="keyword" type="text" placeholder="Enter keywords">
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Genres</label>
                                        <div>
                                            <select name="genre">
                                                <option disabled selected value=""> -- select an option -- </option>
                                                <option value="Action">Action</option>
                                                <option value="Adventure">Adventure</option>
                                                <option value="Comedy">Comedy</option>
                                                <option value="Crime">Crime</option>
                                                <option value="Drama">Drama</option>
                                                <option value="Fantasy">Fantasy</option>
                                                <option value="Historical">Historical</option>
                                                <option value="Horror">Horror</option>
                                                <option value="Mystery">Mystery</option>
                                                <option value="Sci-Fi">Sci-Fi</option>
                                                <option value="Romance">Romance</option>
                                                <option value="Thriller">Thriller</option>
                                                <option value="Western">Western</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Rating Range</label>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <input name="from" type="text" placeholder="From">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="to" type="text" placeholder="To">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Release Year</label>
                                        <input name="year" type="text" placeholder="Enter release year">
                                    </div>
                                    <div class="col-md-12 ">
                                        <input class="submit" type="submit" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
