@extends('userLayout')
@section('followers')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class=" title-hd-sm">
            <h4>List of followers <i class="ion-ios-arrow-right"></i></h4>

        </div>
        <div class="flex-wrap-movielist grid-fav">
            @foreach ($followers as $f)

                <div class="movie-item-style-2 movie-item-style-1 style-3">
                    <img src="/images/users/{{ $f->user->avatar }}" alt="">
                    <div class="hvr-inner">
                        <a href="/users/{{ $f->user->id }}"> See <i class="ion-android-arrow-dropright"></i>
                        </a>
                    </div>
                    <div class="mv-item-infor">
                        <h6><a href="/users/{{ $f->user->id }}">{{ $f->user->firstName }} {{ $f->user->lastName }}</a>
                        </h6>

                    </div>
                </div>

            @endforeach
        </div>


    </div>
@endsection
