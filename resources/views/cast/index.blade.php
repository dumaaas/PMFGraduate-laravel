@extends('layout')
@section('castList')
    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Celebrity list</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Home</a></li>
                            <li> <span class="ion-ios-arrow-right"></span> celebrity listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- celebrity list section-->
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <form method="GET" action="/sortCast">
                        @csrf
                        <div class="topbar-filter">
                            <p class="pad-change">Found <span>{{ $castNum }} celebrities</span> in total</p>
                            <label>Sort by:</label>

                            <select name="sort">
                                <option disabled selected value=""> -- select an option -- </option>
                                <option value="a-z">A-Z</option>
                                <option value="z-a">Z-A</option>
                                <option value="birthDate">From oldest</option>
                                <option value="birthDate1">From youngest</option>
                                <option value="mostFavorite">Most favorite</option>
                                <option value="leastFavorite">Least favorite</option>
                                <option value="mostMovies">Most movies</option>
                                <option value="leastMovies">Least movies</option>
                            </select>


                            <button>SORT</button>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($casts as $cast)

                                <div class="ceb-item-style-2">
                                    <img src="/images/actors/{{ $cast->avatar }}" alt="" width="115px">
                                    <div class="ceb-infor">
                                        <h2><a href="/cast/{{ $cast->id }}">{{ $cast->firstName }} {{ $cast->lastName }}</a>
                                        </h2>
                                        <span>{{ $cast->occupation }}, {{ $cast->country }}, {{ $cast->birthDate }}</span>
                                        <p>{{ $cast->description }} </p>
                                    </div>
                                </div>


                            @endforeach
                            {{-- {{ $casts->links() }} --}}
                        </div>

                    </div>

                </div>
                <div class="col-md-3 col-xs-12 col-sm-12">
                    <div class="sidebar">
                        <div class="searh-form">
                            <h4 class="sb-title">Search celebrity</h4>
                            <form class="form-style-1 celebrity-form" action="/searchCast" method="GET">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label>Celebrity name</label>
                                        <input name="keyword" type="text" placeholder="Enter keywords">
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Celebrity Letter</label>
                                        <select name="letter">
                                            <option disabled selected value=""> -- select an option -- </option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="H">H</option>
                                            <option value="I">I</option>
                                            <option value="J">J</option>
                                            <option value="K">K</option>
                                            <option value="L">L</option>
                                            <option value="M">M</option>
                                            <option value="N">N</option>
                                            <option value="O">O</option>
                                            <option value="P">P</option>
                                            <option value="Q">Q</option>
                                            <option value="R">R</option>
                                            <option value="S">S</option>
                                            <option value="T">T</option>
                                            <option value="U">U</option>
                                            <option value="V">V</option>
                                            <option value="W">W</option>
                                            <option value="X">X</option>
                                            <option value="Y">Y</option>
                                            <option value="Z">Z</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Category</label>
                                        <select name="category">
                                            <option disabled selected value=""> -- select an option -- </option>
                                            <option value="Actress">Actress</option>
                                            <option value="Actor">Actor</option>
                                            <option value="Director">Director</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-it">
                                        <label>Country</label>
                                        <input name="country" type="text" placeholder="Country">
                                    </div>
                                    <div class="col-md-12 ">
                                        <input class="submit" type="submit" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="celebrities">
                            <h4 class="sb-title">featured celebrity</h4>
                            @foreach ($mostFeatured as $mf)
                                <div class="celeb-item">
                                    <a href="#"><img src="/images/actors/{{ $mf->avatar }}" alt="" width="70px"></a>
                                    <div class="celeb-author">
                                        <h6><a href="/cast/{{ $mf->id }}">{{ $mf->firstName }} {{ $mf->lastName }}</a></h6>
                                        <span>{{ $mf->occupation }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of celebrity list section-->

@endsection
