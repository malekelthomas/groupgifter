@extends('layouts.app')

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
            $categories = DB::select("SELECT * FROM cat");
            //$result = mysqli_query($conn, $sql);
            if(count($categories) > 0){
              foreach($categories as $category){
          ?>
              <div style="vertical-align:middle" id="ellipse<?php echo $category->id;?>" class="ellipse category">
                  <input type="hidden" value=<?php echo $category->properties_key;?> name="category">
                  <p class="paragraph-ellipse-text"><?php echo $category->properties_key;?></p>
              </div>
          <?php
              }
            }
            else {
              echo "No categories";
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
        <p class="choose-cats">Choose Categories</p>
      </div>
    </div>
    <div class="w-100" style="height: 100px;"></div>
    <div class="row justify-content-center">
      <button class="next-button-button" onclick=submitCategories(event);>NEXT</button>
    </div>

@endsection