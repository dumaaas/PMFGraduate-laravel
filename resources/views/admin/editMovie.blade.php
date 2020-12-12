@extends('adminLayout')
@section('editMovie')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <edit-movie :movie="{{$movie}}"></edit-movie>
                </div>
            </div>
        </div>
    </div>

@endsection
