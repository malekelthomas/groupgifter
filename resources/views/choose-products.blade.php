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
        <div class="category-ellipses col-2">

          <?php
            if (!empty($_SESSION["images"])){
              $shuffledImages = $_SESSION["images"];
              $i = 0;
              foreach($shuffledImages as $categories => $products){
                  foreach($products as $details){
                    //details - [product-url, product-img]
                      $links = preg_split("/[,]/", $details);?>
                      <div style="vertical-align:middle; background-size:cover; background-position: center; background-image:url(<?php echo "{$links[1]}";?>); background-repeat:no-repeat;" id="ellipse<?php echo $i;?>" class="ellipse">
                          <?php // echo "<img style = 'min-width:100%; min-height:100%;' value ='{$links[0]}' src={$links[1]}>"; ?>
                          <input type="hidden" name="products[]" value='<?php echo "{$categories}";//{$links[0]} {$links[1]}"?>'/>
                </div><?php
                  $i++;
                  }
              }
          }
          ?>
          
        </div>
        <div class="next-button col-2" onclick="plusSlides(1)">
            <hr class="next-line1">
            <hr class="next-line2">
        </div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
      <div>
        <p class="choose-cats">Choose Products</p>
      </div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
      <button class="next-button-button" onclick=submitProducts(event);>NEXT</button>
    </div>



@endsection