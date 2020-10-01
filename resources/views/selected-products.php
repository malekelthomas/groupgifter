<meta name="csrf-token" content="{{ csrf_token() }}">


<?php

use Illuminate\Support\Facades\Auth;

//get the currently authenticated user
$user = Auth::user();

// Get the currently authenticated user's ID...

$id = Auth::id();

$post = $_POST["products"];

foreach($post as $product => $categories){
    $entry = new App\Models\PickedCategory();
    $entry->user_id = $id;
    $entry->category= $product;
    $entry->num_picked = $post[$product];
    $entry->save();
    echo "$entry\n";

    }





?>