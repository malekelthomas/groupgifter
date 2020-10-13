@extends('layouts.app')


@section('content')


@if (empty($members)) <!-- if no members in group besides current user -->

    <h1 style='color: white'>No Members In Group!</h1>

@else

    @foreach ($members as $member)
        <h1 style='color: white'>{{$member->name}}</h1>
    @endforeach


@endif




@endsection
