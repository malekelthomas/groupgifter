@extends('layouts.app')

<?php session_start(); ?>
@section('content')

    <div class="w-100" style="height: 100px;"></div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">

    <!-- Circles start left, counter-clockwise-->
    <div class="prev-button col-2" onclick="plusSlides(-1)">
        <hr class="prev-line1">
        <hr class="prev-line2">
    </div>
<?php
    if (!empty($_SESSION["images"])){
        $i = 0;
        foreach($_SESSION["images"] as $categories => $products){
            foreach($products as $details){
                //details - [product-url, product-img]
                $links = preg_split("/[,]/", $details);
                if (count($links) == 2){?>
                  <a href="<?php echo $links[0];?>">
                    <div style="vertical-align:middle; background-size:cover; background-position: center; background-image:url(<?php echo "{$links[1]}";?>); background-repeat:no-repeat;" id="ellipse<?php echo $i;?>" class="ellipse product">
                        <?php // echo "<img style = 'min-width:100%; min-height:100%;' value ='{$links[0]}' src={$links[1]}>"; ?>
                        <input type="hidden" name="products[]" value='<?php echo "{$categories}";//{$links[0]} {$links[1]}"?>'/>
                    </div>
                </a>
            <?php
            $i++;
                }
            }
        }
    }

?>

<div class="next-button col-2" onclick="plusSlides(1)">
    <hr class="next-line1">
    <hr class="next-line2">
</div>
<div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
      <div>
        <p class="choose-cats">Suggestions for {{$name}}</p>
      </div>
</div>

@endsection
