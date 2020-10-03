<meta name="csrf-token" content="{{ csrf_token() }}">


<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//get the currently authenticated user
$user = Auth::user();

// Get the currently authenticated user's ID...

$id = Auth::id();

$post = $_POST["products"];

foreach($post as $product => $num_picked){
    $entry = DB::table('picked_categories')->where([['category', '=', $product],['user_id', '=', $id],])->get(); //check if user picked this category before

    if ($entry->count() == 0){//if entry does not exist, create one
        $entry = new App\Models\PickedCategory();
        $entry->user_id = $id;
        $entry->category= $product;
        $entry->num_picked = $num_picked;
        $entry->save();
        echo "Didn't exist\n$entry\n";
    }

    else{

        DB::table('picked_categories')->where([['category', '=', $product],['user_id', '=', $id],])->increment('num_picked',$num_picked);

    }

    echo "$entry\n";


    }





?>
