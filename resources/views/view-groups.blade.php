@extends('layouts.app')

@section('content')




<div class="selector">
    <ul>
        <?php

            $i =0;

            foreach($groups as $group){

                echo "<li>";
                echo "<input type='checkbox' id='c$i'>";
                echo "<label for ='c$i' style='color:#fff'>{$group->name}</label>";
                echo "</li>";
                $i++;
            }
            ?>
    </ul>

    {{-- <div class="selector">
        <ul>
            <li>
                <input type="checkbox" id="c1">
                <label for="c1"></label>
            </li>

        </ul>
    </div> --}}


@endsection
