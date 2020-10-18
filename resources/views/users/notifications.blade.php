@extends('userLayout')
@section('notifications')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div id="comments" class="tab blog-detail-ct">
            <h4>Follower notifications</h4>
            @if ($notifications->isEmpty())
                <p>No new notifications</p>
            @else
                @foreach ($notifications as $n)

                    <div class="cmt-item flex-it">
                        <img src="/images/users/{{ $n->data['follower_avatar'] }}" alt="" style="border-radius: 50%"
                            width="75px">
                        <div class="author-infor">
                            <div class="flex-it2">
                                <p><a href="/users/{{ $n->data['follower_id'] }}">{{ $n->data['follower_firstName'] }}
                                        {{ $n->data['follower_lastName'] }} </a> followed you <br> <br><span
                                        class="time">{{ $n->created_at->diffForHumans() }}</span></p>

                            </div>

                        </div>
                    </div>
                @endforeach
                <br>
            @endif
            <h4>Movie notifications</h4>
            @if ($movieNotifications->isEmpty())
                <p>No new notifications</p>
                @else
                    @foreach ($movieNotifications as $mn)
                        <div class="cmt-item flex-it">
                            <img src="/images/movies/{{ $mn->data['movie_avatar'] }}" alt="" width="75px">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p><a href="/movies/{{ $mn->data['movie_id'] }}">{{ $mn->data['movie_name'] }}</a>,
                                        {{ $mn->data['movie_genre'] }}, {{ $mn->data['movie_releaseYear'] }} <br>
                                        <br><span class="time">{{ $mn->created_at->diffForHumans() }}</span></p>
                                </div>

                            </div>
                        </div>
                    @endforeach
            @endif


        </div>
    </div>

@endsection
