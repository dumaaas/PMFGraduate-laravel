@extends('adminLayout')

@section('dashboard')

    <div class="content">
        <div class="container-fluid">
            <admin-stats :moviesnum="{{$moviesNum}}" :user="{{Auth::user()}}" :movie="{{$movie}}"></admin-stats>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Latest users</h4>
                            <p class="card-category">New employees on 15th September, 2016</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->country }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Latest movies</h4>
                            <p class="card-category">New employees on 15th September, 2016</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Genre</th>
                                    <th>Year</th>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>{{ $movie->id }}</td>
                                            <td>{{ $movie->name }}</td>
                                            <td>{{ $movie->genre }}</td>
                                            <td>{{ $movie->releaseYear }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Latest comments</h4>
                            <p class="card-category">New employees on 15th September, 2016</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>Movie</th>
                                    <th>User</th>
                                    <th>Text</th>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td></td>
                                            <td>{{ $comment->user->username }}</td>
                                            <td>{{ Str::limit($comment->content, 20) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Latest ratings</h4>
                            <p class="card-category">New employees on 15th September, 2016</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>Movie</th>
                                    <th>User</th>
                                    <th>Rating</th>
                                </thead>
                                <tbody>
                                    @foreach ($ratings as $rating)
                                        <tr>
                                            <td>{{ $rating->movie->name }}</td>
                                            <td>{{ $rating->user->username }}</td>
                                            <td><i class="fa fa-star"></i> {{ $rating->rating}}/10 </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
