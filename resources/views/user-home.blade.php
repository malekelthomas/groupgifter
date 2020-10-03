@extends('layouts.app')
<?php

use Illuminate\Support\Facades\Auth;

?>
@section('content')


<div class="w-100" style="height: 100px;"></div>
<div class="w-100" style="height: 100px;"></div>
<div class="wrapper">
    <div class="row justify-content-center">

        <div id="profile_picture">
            <img src="/images/blank-profile-picture-png.png" alt="">
        </div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
        <div class="user-home-btn col-sm-2 mb-3">
            <p style="margin-top: 10%"><strong>CHOOSE PRODUCTS</strong></p>
        </div>
        <div class="user-home-btn col-sm-2 offset-sm-1 mb-3">
            <p style="margin-top: 10%"><strong>VIEW GROUPS</strong></p>
        </div>
        <div class="user-home-btn col-sm-2 offset-sm-1 mb-3">
            <p style="margin-top: 10%"><strong>CREATE GROUP</strong></p>
        </div>

    </div>


</div>
@endsection
