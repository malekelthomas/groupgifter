@extends('layouts.app')


@section('content')

<?php session_start(); ?>
<div class="wrapper">
    <div class="w-100" style="height: 100px;"></div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
        <p id="user-name"> Would you like to add {{$name}} to {{$groupToJoin}}?</p>
        <div class="w-100" style="height: 100px;"></div>
        <div class="w-100" style="height: 100px;"></div>
    </div>


    <div class="row justify-content-center">
        <form id="addToGroupForm" method="POST" action="/group/addToGroup">
            @csrf
            <input type="hidden" name="id" value="{{$fromId}}">
            <input type="hidden" name="groupToAddTo" value="{{$groupToJoinId}}">
        </form>
            <button id="accept" class="user-home-btn col-sm-2 mb-3">
                <a href="#" style="color: #212529"><p style="margin-top: 10%; text-align:center;"><strong>ACCEPT</strong></p></a>
            </button>
        <button class="user-home-btn col-sm-2 offset-sm-1 mb-3">
            <a href="#" style="color: #212529"><p style="margin-top: 10%; text-align:center;"><strong>DENY</strong></p></a>
        </button>
    </div>
</div>




@endsection
