@extends('layouts.app')

<?php session_start(); ?>
@section('content')

<?php
    if (!empty($_SESSION["images"])){
        $i = 0;
        foreach($_SESSION["images"] as $categories => $products){
            foreach($products as $details){
                //details - [product-url, product-img]
                $links = preg_split("/[,]/", $details);
                if (count($links) == 2){?>
                <div style="vertical-align:middle; background-size:cover; background-position: center; background-image:url(<?php echo "{$links[1]}";?>); background-repeat:no-repeat;" id="ellipse<?php echo $i;?>" class="ellipse product">
                    <?php // echo "<img style = 'min-width:100%; min-height:100%;' value ='{$links[0]}' src={$links[1]}>"; ?>
                    <input type="hidden" name="products[]" value='<?php echo "{$categories}";//{$links[0]} {$links[1]}"?>'/>
                </div>
            <?php
            $i++;
                }
            }
        }
    }

    else {
        echo var_dump($_SESSION);
    }


?>



@endsection
