@extends('layouts.app')

<?php

use Illuminate\Support\Facades\Auth;
$id = Auth::id();
?>

@section('content')


<form  id="notificationForm" method="POST" action="/send-notification">
    @csrf


    <input type="hidden" id="{{$member}}" name="member" value="{{$member}}">
    <input type="hidden" id="{{$group}}" name="group" value="{{$group}}">
    <input type="hidden" id = "<?php echo $id;?>" name="memberId" value="<?php echo $id;?>">
    <input type="hidden" id="groupId" name="groupId" value="{{$groupId}}">

</form>


@endsection
