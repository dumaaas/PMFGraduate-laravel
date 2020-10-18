@extends('layout')
@section('home')
    <div class="slider movie-items">
        <div class="container">
            <div class="row">
                <div class="social-link">

                </div>
                <div class="slick-multiItemSlider">
                    @foreach ($randomMovies as $rm)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#"><img src="/images/movies/{{ $rm->avatar }}" alt="" width="285px"
                                        height="437px"></a>
                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    <span class="blue"><a href="#">{{ $rm->genre }}</a></span>
                                </div>
                                <h6><a href="/movies/{{ $rm->id }}">{{ $rm->name }}</a></h6>
                                <p><i class="ion-android-star"></i><span>{{ $rm->imdb }}</span> /10</p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <div class="movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-8">
                    <div id="app" class="title-hd">

                        @auth
                            <h2>Recommended for you</h2>

                        @endauth
                        @guest
                            <h2>Join us</h2>
                        @endguest
                        <a href="/movies" class="viewall">View all movies <i class="ion-ios-arrow-right"></i></a>
                    </div>
                    <div class="tabs">
                        <ul class="tab-links">
                            <li class="active"><a href="#tab1">#Popular</a></li>
                            <li><a href="#tab2"> #Top rated</a></li>
                            <li><a href="#tab3"> #Most watched </a></li>
                            {{-- <li><a href="#tab4"> #Most reviewed</a></li>
                            --}}
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab active">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($popularMovies as $pm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $pm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $pm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $pm->id }}">{{ $pm->name }}</a></h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $pm->imdb }}</span> /10
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($topRatedMovies as $trm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $trm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $trm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $trm->id }}">{{ $trm->name }}</a></h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $trm->imdb }}</span> /10
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($mostWatchedMovies as $mwm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $mwm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $mwm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $mwm->id }}">{{ $mwm->name }}</a></h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $mwm->imdb }}</span> /10
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="tab4" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        <div class="slide-it">
                                            <div class="movie-item">
                                                <div class="mv-img">
                                                    <img src="images/uploads/mv-item5.jpg" alt="" width="185" height="284">
                                                </div>
                                                <div class="hvr-inner">
                                                    <a href="moviesingle.html"> Read more <i
                                                            class="ion-android-arrow-dropright"></i> </a>
                                                </div>
                                                <div class="title-in">
                                                    <h6><a href="#">Interstellar</a></h6>
                                                    <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide-it">
                                            <div class="movie-item">
                                                <div class="mv-img">
                                                    <img src="images/uploads/mv-item6.jpg" alt="" width="185" height="284">
                                                </div>
                                                <div class="hvr-inner">
                                                    <a href="moviesingle.html"> Read more <i
                                                            class="ion-android-arrow-dropright"></i> </a>
                                                </div>
                                                <div class="title-in">
                                                    <h6><a href="#">The revenant</a></h6>
                                                    <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide-it">
                                            <div class="movie-item">
                                                <div class="mv-img">
                                                    <img src="images/uploads/mv-item7.jpg" alt="" width="185" height="284">
                                                </div>
                                                <div class="hvr-inner">
                                                    <a href="moviesingle.html"> Read more <i
                                                            class="ion-android-arrow-dropright"></i> </a>
                                                </div>
                                                <div class="title-in">
                                                    <h6><a href="#">Die hard</a></h6>
                                                    <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide-it">
                                            <div class="movie-item">
                                                <div class="mv-img">
                                                    <img src="images/uploads/mv-item8.jpg" alt="" width="185" height="284">
                                                </div>
                                                <div class="hvr-inner">
                                                    <a href="moviesingle.html"> Read more <i
                                                            class="ion-android-arrow-dropright"></i> </a>
                                                </div>
                                                <div class="title-in">
                                                    <h6><a href="#">The walk</a></h6>
                                                    <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide-it">
                                            <div class="movie-item">
                                                <div class="mv-img">
                                                    <img src="images/uploads/mv-item3.jpg" alt="" width="185" height="284">
                                                </div>
                                                <div class="hvr-inner">
                                                    <a href="moviesingle.html"> Read more <i
                                                            class="ion-android-arrow-dropright"></i> </a>
                                                </div>
                                                <div class="title-in">
                                                    <h6><a href="#">Die hard</a></h6>
                                                    <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="title-hd">
                        <h2>Latest added</h2>
                        <a href="/movies" class="viewall">View all movies <i class="ion-ios-arrow-right"></i></a>
                    </div>
                    <div class="tabs">
                        <ul class="tab-links-2">
                            <li><a href="#tab21">#Action</a></li>
                            <li class="active"><a href="#tab22"> #Drama</a></li>
                            <li><a href="#tab23">#Comedy</a></li>
                            <li><a href="#tab24">#Horror</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab21" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($latestActionMovies as $lam)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $lam->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $lam->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $lam->id }}">{{ $lam->name }}</a></h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $lam->imdb }}</span> /10
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div id="tab22" class="tab active">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($latestDramaMovies as $ldm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $ldm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $ldm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $ldm->id }}">{{ $ldm->name }}</a></h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $ldm->imdb }}</span>
                                                            /10</p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="tab23" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($latestComedyMovies as $lcm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $lcm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $lcm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $lcm->id }}">{{ $lcm->name }}</a>
                                                        </h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $lcm->imdb }}</span>
                                                            /10</p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="tab24" class="tab">
                                <div class="row">
                                    <div class="slick-multiItem">
                                        @foreach ($latestHorrorMovies as $lhm)

                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img src="images/movies/{{ $lhm->avatar }}" alt="" width="185"
                                                            height="284">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="/movies/{{ $lhm->id }}"> See <i
                                                                class="ion-android-arrow-dropright"></i> </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="/movies/{{ $lhm->id }}">{{ $lhm->name }}</a>
                                                        </h6>
                                                        <p><i class="ion-android-star"></i><span>{{ $lhm->imdb }}</span>
                                                            /10</p>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="celebrities">
                            <h4 class="sb-title">Spotlight Celebrities</h4>
                            @foreach ($featuredCelebrities as $fc)
                                <div class="celeb-item">
                                    <a href="/cast/{{ $fc->id }}"><img src="/images/actors/{{ $fc->avatar }}" alt=""
                                            width="70" height="70"></a>
                                    <div class="celeb-author">
                                        <h6><a href="/cast/{{ $fc->id }}">{{ $fc->firstName }}
                                                {{ $fc->lastName }}</a></h6>
                                        <span>{{ $fc->occupation }}</span>
                                    </div>
                                </div>
                            @endforeach


                            <a href="/cast" class="btn">See all celebrities<i class="ion-ios-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="trailers">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12">
                    <div class="title-hd">
                        <h2>in theater</h2>
                        <a href="/movies" class="viewall">View all movies <i class="ion-ios-arrow-right"></i></a>
                    </div>
                    <div class="videos">
                        <div class="slider-for-2 video-ft">
                            @foreach ($trailerMovies as $tm)
                                <div>
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/AZGcmvrTX9M"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider-nav-2 thumb-ft">
                            @foreach ($trailerMovies as $tm)
                                <div class="item">
                                    <div class="trailer-img">
                                        <img src="images/movies/{{ $tm->avatar }}" alt="photo by Barn Images" width="4096"
                                            height="2737">
                                    </div>
                                    <div class="trailer-infor">
                                        <h4 class="desc">{{ $tm->name }}</h4>
                                        <p>{{ $tm->duration }} min</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

@endsection
