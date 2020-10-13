@extends('layouts.app')

@section('content')




<form id="userGroupsForm" method ="POST" action="/group/viewmembers">
    @csrf
    <div class="selector">
        <ul>
            <?php

                $i =0;

                foreach($groups as $group){

                    echo "<li>";
                    echo "<input onchange='this.form.submit()' type='checkbox' id='c$i' name='group' value={$group->name}>";
                    echo "<label for ='c$i' style='color:#fff'>{$group->name}</label>";
                    echo "</li>";
                    $i++;
                }
                ?>
        </ul>
    </div>
</form>

    {{-- <div class="selector">
        <ul>
            <li>
                <input type="checkbox" id="c1">
                <label for="c1"></label>
            </li>

        </ul>
    </div> --}}


@endsection
