@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="prev-button"></div>
        <hr class="prev-line1">
        <hr class="prev-line2">
        <!-- Circles start left, counter-clockwise-->
        <div id="category-ellipses">

        <?php
          $categories = DB::select("SELECT * FROM cat LIMIT 0,8");
          //$result = mysqli_query($conn, $sql);
          if(count($categories) > 0){
            foreach($categories as $category){
                echo $category->id."<br>";
                }
            }
        /* ?>
          <div style="vertical-align:middle" id="ellipse<?php echo $id?>" class="ellipse">
            <input type="hidden" value=<?php echo $row['properties_key']?> name="category"><p class="paragraph-ellipse-text"><?php echo $row['properties_key'];?></p>
          </div>
          <?php
            }
        }
        else {
          echo "No categories";
        } */
          ?>
        </div>
        <div id="seeMore" class="next-button"></div>
        <hr class="next-line1">
        <hr class="next-line2">
    </div>
    <div class="get-started"></div>
      <span class="choose-cats">Choose Categories</span>
    </div>
    <div class="next-button-page">
      <button class="next-button-button" onclick=submitCategories(event);>NEXT</button>
    </div>

@endsection