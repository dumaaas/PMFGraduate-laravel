@extends('userLayout')
@section('following')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class=" title-hd-sm">
            <h4>List of following <i class="ion-ios-arrow-right"></i></h4>

        </div>
        <div class="flex-wrap-movielist grid-fav">
            @foreach ($following as $f)

                <div class="movie-item-style-2 movie-item-style-1 style-3">
                    <img src="/images/users/{{ $f->avatar }}" alt="">
                    <div class="hvr-inner">
                        <a href="/users/{{ $f->id }}"> See <i class="ion-android-arrow-dropright"></i>
                        </a>
                    </div>
                    <div class="mv-item-infor">
                        <h6><a href="/users/{{ $f->id }}">{{ $f->firstName }} {{ $f->lastName }}</a>
                        </h6>

                    </div>
                </div>

            @endforeach
        </div>
    @endsection
