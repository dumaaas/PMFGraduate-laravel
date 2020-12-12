@extends('adminLayout')
@section('table')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @yield('userTable')
                    @yield('movieTable')
                    @yield('commentTable')
                    @yield('ratingTable')
                </div>
            </div>
        </div>
    </div>
@endsection
