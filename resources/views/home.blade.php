@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100" style="height: 100px;"></div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="wrapper">
        <div class="row justify-content-center">
            <div id="video-svg" class="col-2 pr-3" style="height: 190px;width: 190px;">
                <img id="video-svg-img" src ="/svg/video-marketing.svg">
            </div>
            <div id="tshirt-svg" class="col-2 pl-3"  style="height: 190px;width: 190px;">
                <img id="tshirt-svg-img"src ="/svg/tshirt.svg">
            </div>
            <div id="journal-svg" class="col-2 offset-1" style="height: 190px;width: 190px;">
                <img id="journal-svg-img"src ="/svg/journal.svg">
            </div>
            <div id="shopping-basket-svg" class="col-2 pr-1" style="height: 190px;width: 190px;">
                <img id="shopping-basket-svg-img" src ="/svg/shopping-basket.svg">
            </div>
        </div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
        @if (Route::has('login'))
            @auth
            <a href="/userhome">

        @else
            <a href="/login">
        @endif
        @endif
        <button class="get-started-button">GET STARTED HERE</button></a>
    </div>
</div>
@endsection
