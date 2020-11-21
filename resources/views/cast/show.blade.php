@extends('layout')
@section('showCast')
    <div class="hero hero3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
    <!-- celebrity single section-->

    <div class="page-single movie-single cebleb-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    @include('flash::message')
                    <div class="mv-ceb">
                        <img src="/images/actors/{{ $cast->avatar }}" alt="">
                    </div>

                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="movie-single-ct">
                        <h1 class="bd-hd">{{ $cast->firstName }} {{ $cast->lastName }} </h1>
                        <h1 class="bd-hd"><span>{{ $cast->occupation }} </span> </h1>

                        <div class="social-btn">
                            @auth
                            @if ($cast->isInFavoriteCast($cast->id))
                                <a href="{{route('likeable.cast', ['cast' => $cast->id, 'type' => 'down'])}}" class="parent-btn"><i class="ion-heart"></i>
                                    Remove Favorite</a>

                            @else
                                <a href="{{route('likeable.cast', ['cast' => $cast->id, 'type' => 'up'])}}" class="parent-btn"><i class="ion-heart"></i>
                                    Add to Favorite</a>
                            @endif
                            @endauth
                            @guest
                                <a href="#" class="parent-btn"><i class="ion-heart"></i>
                                    Add to Favorite</a>
                            @endguest

                        </div>

                        <div class="movie-tabs">
                            <div class="tabs">
                                <ul class="cont3 tab-links tabs-mv">
                                    <li class="active"><a href="#overviewceb">Biography</a></li>
                                    <li><a href="#filmography">Filmography</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="overviewceb" class="tab active">

                                        <div class="cont row">

                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                <div class="title-hd-sm">
                                                    <h4>Biography <i class="ion-ios-arrow-right"></i></h4>

                                                </div>
                                                <p>{{ $cast->description }} </p>
                                            </div>

                                            <div class="col-md-4 col-xs-12 col-sm-12">
                                                <div class="sb-it">
                                                    <br /><br />
                                                    <h6>Fullname: </h6>
                                                    <p>{{ $cast->firstName }} {{ $cast->lastName }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Date of Birth: </h6>
                                                    <p>{{ $cast->birthDate }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Country: </h6>
                                                    <p>{{ $cast->country }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Height:</h6>
                                                    <p>{{ $cast->height }} cm</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="filmography" class="tab">
                                        <div class="row">

                                            <div class="topbar-filter">
                                                <p>Found <span>{{ $moviesNum }} movies</span> in total</p>
                                            </div>
                                            <!-- movie cast -->
                                            <div class="mvcast-item">
                                                @foreach ($actings as $acting)
                                                    <div class="cast-it">
                                                        <div class="cast-left cebleb-film">
                                                            <img src="/images/movies/{{$acting->movie->avatar}}" alt="" width="70px" height="35px">
                                                            <div>
                                                                <a href="/movies/{{ $acting->movie->id }}">{{ $acting->movie->name }}
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <p>... {{ $acting->movie->releaseYear }}</p>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
