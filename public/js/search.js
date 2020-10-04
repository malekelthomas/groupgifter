
function submitSearch(){
    var form = document.getElementById("notificationForm")

    if(form !== null){
        form.submit();
    }
    console.log(form)

  }


jQuery(function (){

    submitSearch();

})
