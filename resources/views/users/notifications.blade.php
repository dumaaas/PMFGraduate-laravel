@extends('userLayout')
@section('notifications')
    <notifications-all :default_notifications="{{$notifications}}" :user="{{Auth::user()}}"></notifications-all>
@endsection
