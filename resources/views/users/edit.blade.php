@extends('userLayout')

@section('editProfile')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="form-style-1 user-pro" action="">
            <edit-details :user="{{$user}}"></edit-details>
            <br>
            <edit-privacy :user="{{$user}}"></edit-privacy>
            <edit-password :user="{{$user}}"></edit-password>
        </div>
    </div>
@endsection

