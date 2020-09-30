async function fetchProducts(keyword){
    var keyword = keyword
    var encoded_keyword = encodeURI(keyword)
    let response =  await fetch("https://amazon-product-reviews-keywords.p.rapidapi.com/product/search?category=aps&country=US&keyword="+encoded_keyword, 
    {
      "method": "GET",
      "headers": {
        "x-rapidapi-host":"amazon-product-reviews-keywords.p.rapidapi.com",
        "x-rapidapi-key":"9c84970b7cmsh058c44f8d18fec6p1096c6jsn84399aedcce4"
      }
    })
    console.log(response)
    let data = await response.json();
    //console.log(data);
    return data;
    }
  
  
  function fetchCategories(){
      var settings = {
          "async": true,
          "crossDomain": true,
          "url": "https://amazon-product-reviews-keywords.p.rapidapi.com/categories?country=US",
          "method": "GET",
          "headers": {
              "x-rapidapi-host":"amazon-product-reviews-keywords.p.rapidapi.com",
              "x-rapidapi-key":"9c84970b7cmsh058c44f8d18fec6p1096c6jsn84399aedcce4"
          }
      }
      console.log(settings);
      $.ajax(settings).done(function (response) {
          console.log(response);
      });
  }
  
  var categoriesClicked = [];
  
  async function submitCategories(e){
    e.preventDefault();
    var products = {};
  
    for(var i = 0; i < categoriesClicked.length; i++){
      products[`${categoriesClicked[i]}`] = await fetchProducts(categoriesClicked[i]);
    }
    console.log(products);
    
    $.ajax({
      type:"POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/products",
      data: products,
      success: function(data){
        console.log(data);
        window.location = '/chooseproducts'
      },
      error: function(data){
        console.log("error: ",data)
      }
    })
    }
  
  function submitProducts(){
    $.ajax({
      url: '/selectedproducts',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: {"products":categoriesClicked},
      success: function (data){
        console.log(data,"submitted data")
      },
      error: function (data){
        console.log("error")
      }
    })
  }
  
  
  console.log(categoriesClicked);
  function storeCategoriesClicked(element){
    var clickVal = $(element).children('input').val()+"";
    if(categoriesClicked.includes(clickVal)){
      categoriesClicked = categoriesClicked.filter(value => value!=clickVal)
    }
    else{
    categoriesClicked.push(clickVal)
    }
    console.log(categoriesClicked)
    if ($(element).css("border-top-color") == "rgb(33, 37, 41)"){
      $(element).css("border", "3px solid rgba(240, 165, 0, 0.698)")
      //var url_imgLink= $(this).attr('value')+" "+$(this).attr('src');
      //$(`#products-images-form :input[value="${url_imgLink}"]`).val(`${url_imgLink} checked`)
      //console.log($('#products-images-form'))
      return false;
    }
    console.log($(element).css("border-top-color"))
    if ($(element).css("border-top-color") == "rgba(240, 165, 0, 0.698)"){
      $(element).css("border", "none");
      return false;
    }
    
  }


  
  
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var ellipses = document.getElementsByClassName("ellipse");
  var dots = document.getElementsByClassName("dot");
  if (n > ellipses.length) {slideIndex = 1}
    if (n < 1) {slideIndex = ellipses.length}
    for (i = 0; i < ellipses.length; i++) {
      ellipses[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
  ellipses[slideIndex-1].style.display = "block";
  //dots[slideIndex-1].className += " active";
}

  jQuery(function (){
    var checkboxes = $("#categories");
    var checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {};
    var seeMore = $("#seeMore");
    var append_start = 0;
    var numCats = 8;
    var tableBody = $("#selected-cats tbody");
    var seeProducts = $("#getProducts");
  
    $(".ellipse").click(function(){
      console.log($(this).children('input').val())
      storeCategoriesClicked(this);
    });
    $.each(checkboxValues, function(key, val){
      $("#"+key).prop("checked", val);
      if(val){
        $("#selected-cats > tbody:last-child").append(`<tr id = ${key}><td><input type="hidden" name="categories[]" value='${key}'/>${key}</td></tr>`);
      }
    });
  
    function updateStorage(){
      $("input[type=checkbox]").each(function(){
        checkboxValues[this.id] = this.checked;
      })
      localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues))
    }
  
    checkboxes.on("change", "input[type=checkbox]", function(){ 
      if (this.checked){
          var search = tableBody.find(`#${this.value}`);
          if (search.length == 0){ //length is number of matched elements
            $("#selected-cats > tbody:last-child").append(`<tr id = ${this.value}><td><input type="hidden" name="categories[]"/>${this.value}</td></tr>`);
          }
        }
      if (this.checked == false){
          tableBody.find(`#${this.value}`).remove();
        }
        updateStorage();
    })
  
    seeMore.on("click", function(){
      console.log("clicked")
      append_start = numCats;
      numCats+=1;
      var id = numCats%8==0?8:numCats%8;
      console.log(`ellipse${id}`)
      document.getElementById(`ellipse${id}`).remove();
      $("#category-ellipses").load("load_categories.php", {
        append: append_start,
        newNumCats: numCats
      })
    })
  
    //document.getElementById("back-to-selection").style.display="none";
  
    if(categoriesClicked.length >0){
      seeProducts.on("click", function (){
      $("img").on("click", function(){
        if ($(this).css("border-top-color") == "rgb(0, 0, 0)"){
          $(this).css("border", "3px solid red");
          var url_imgLink= $(this).attr('value')+" "+$(this).attr('src');
          $(`#products-images-form :input[value="${url_imgLink}"]`).val(`${url_imgLink} checked`)
          console.log($('#products-images-form'))
          return false;
        }
        if ($(this).css("border-top-color") == "rgb(255, 0, 0)"){
          $(this).css("border", "3px solid black");
          return false;
        }
      })
    });
    }
  
    $("#back-button").on("click", function(){
      console.log("clicked")
      document.getElementById("checkbox-table").style.display="block";
      document.getElementById("products").style.display="none";
      document.getElementById("back-to-selection").style.display="none";
  
    })
    
  
    
    
    
  })
  
  
  
    
  
  
  