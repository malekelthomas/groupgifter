@extends('layouts.app')
<?php

use Illuminate\Support\Facades\Auth;
$user = Auth::user();
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
        <div><p id="user-name"><?echo $user->name;?></p></div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
        <div class="user-home-btn col-sm-2 mb-3">
           <a href="/choosecategories" style="color: #212529"><p style="margin-top: 10%; text-align:center;"><strong>CHOOSE PRODUCTS</strong></p></a>
        </div>
        <div class="user-home-btn col-sm-2 offset-sm-1 mb-3">
            <a href="#" style="color: #212529"><p style="margin-top: 10%; text-align:center;"><strong>VIEW GROUPS</strong></p></a>
        </div>
        <div class="user-home-btn col-sm-2 offset-sm-1 mb-3">
            <a href="#" style="color: #212529"><p style="margin-top: 10%; text-align:center;"><strong>CREATE GROUP</strong></p></a>
        </div>

    </div>


</div>
@endsection
