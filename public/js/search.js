function submitSearch(){
    var form = document.getElementById("notificationForm")

    if(form !== null){
        form.submit();
    }
    console.log(form)

  }

function joinRequestSubmit(){
    var form = document.getElementById("joinRequests")

    if(form !== null){
        var joinNotifications = document.getElementsByClassName("joinlink")
        for(i = 0; i < joinNotifications.length; i++){
            console.log(joinNotifications[i])
            joinNotifications[i].addEventListener("click", function (){
                console.log(this)
                form.submit();
            });
        }
    }
    console.log(form)
}

jQuery(function (){

    submitSearch();
    joinRequestSubmit();

})
