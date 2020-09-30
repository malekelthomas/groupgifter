<meta name="csrf-token" content="{{ csrf_token() }}">


<?php

$post = $_POST["products"];

foreach($post as $product => $categories){
    echo "$product,$post[$product]\n";
    }





?>