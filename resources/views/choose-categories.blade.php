@extends('layouts.app')

@section('content')
    <div class="container">
        
        
        <!-- Circles start left, counter-clockwise-->
        <div id="category-ellipses">
          <div class="prev-button" onclick="plusSlides(-1)"></div>
            <hr class="prev-line1">
            <hr class="prev-line2">

          <?php
            $categories = DB::select("SELECT * FROM cat");
            //$result = mysqli_query($conn, $sql);
            if(count($categories) > 0){
              foreach($categories as $category){
          ?>
              <div style="vertical-align:middle" id="ellipse<?php echo $category->id;?>" class="ellipse">
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
          <div class="next-button" onclick="plusSlides(1)"></div>
            <hr class="next-line1">
            <hr class="next-line2">
        </div>
    </div>
    <div class="get-started"></div>
      <span class="choose-cats">Choose Categories</span>
    </div>
    <div class="row justify-content-center">
      <button class="next-button-button" onclick=submitCategories(event);>NEXT</button>
    </div>

@endsection