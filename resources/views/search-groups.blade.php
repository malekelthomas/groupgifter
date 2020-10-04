@extends('layouts.app')


@section('content')


<form  id="notificationForm" method="POST" action="/send-notification">
    @csrf


    <input type="hidden" id="{{$member}}" name="member" value="{{$member}}">


</form>


@endsection
