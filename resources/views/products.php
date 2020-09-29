<meta name="csrf-token" content="{{ csrf_token() }}">

<?php
    session_start();
    $post_data = $_POST;
    //echo var_dump($_POST);
    $data = json_encode($post_data);
    $data = json_decode($data, true);
    $img_arr = array();
    $i = 0;
    foreach($data as $key => $val){
        foreach($val as $descriptions => $descriptor){
            if (is_array($descriptor)){
                foreach($descriptor as $details){
                    foreach($details as $product){
                        if (is_array($product) == false) {
                        if(strpos($product,"https") !== false){
                            if(strpos($product, ".jpg") == false){
                                if (is_array($product) == false){
                                    echo "$key,$product\n";
                                    if (!isset($img_arr["$key"])){
                                        $img_arr["$key"] = array();
                                        }
                                    $img_arr[$key][$i] = "$product";

                                }
                            }
                        
                            elseif(strpos($product, ".jpg") !== false){
                                if (is_array($product) == false){
                                    //echo "$key,$stuff\n";
                                    if ($img_arr["$key"] == null){
                                        $img_arr["$key"] = array();
                                        }
                                    
                                    $img_arr[$key][$i].=",$product";
                                    $i++;
                                }
                            }
                        }
                        }
                    }
                }
            }
        }
    }
    echo var_dump($img_arr);
    $_SESSION["images"] = $img_arr;
?>
