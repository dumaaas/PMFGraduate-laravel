@extends('adminLayout')

@section('dashboard')

    <div class="content">
        <div class="container-fluid">
            <admin-stats :user="{{Auth::user()}}"></admin-stats>
        </div>
    </div>
@endsection
