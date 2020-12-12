@extends('adminLayout')
@section('newMovie')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <add-movie :actors="{{$actors}}"></add-movie>
                </div>

            </div>
        </div>
    </div>

@endsection
