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

function acceptJoinRequestSubmit(){
    var form = document.getElementById("addToGroupForm")

    if(form !== null){
        var submitButton = document.getElementById("accept")
        submitButton.addEventListener("click", function (){
                console.log(this)
                form.submit();
            });
        }
        console.log(form)
    }

function groupMembersSubmit(){
    var form = document.getElementById("groupMembersForm")
    var members = document.querySelectorAll(".member")
    if(form !== null){
        members.forEach(element => element.addEventListener("change", function (){
            if (this.checked){
                console.log(this.value)
                $.ajax({
                    url: `/pickedCategory/${this.value}`,
                    type: "GET",
                    success: function (result){
                        var values = ""
                        result.forEach(element => values+=element["category"]+=" ")
                        console.log(values)
                        $(".selector").html(`<h1 style='color:white'>${values}</h1`);
                    }

                })
            }
        }))
    }
}

jQuery(function (){

    submitSearch();
    joinRequestSubmit();
    acceptJoinRequestSubmit();
    groupMembersSubmit();
})
