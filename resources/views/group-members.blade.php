@extends('layouts.app')


@section('content')


@if (empty($members)) <!-- if no members in group besides current user -->

    <h1 style='color: white'>No Members In Group!</h1>

@else
    <form id="groupMembersForm">
        @csrf
        <div class="selector">
            <ul>
                @foreach ($members as $member)
                <li>
                    <input class="member" type="checkbox" name="member" value="{{$member->id}}">
                    <label style='color: white'>{{$member->name}}</h1>
                </li>
                @endforeach
            </ul>
        </div>

    </form>


@endif




@endsection
