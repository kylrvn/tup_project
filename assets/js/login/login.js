$(document).ready(function () {
    $('#Login').on('click', function () {

        $.ajax({
            url: base_url + 'login/service/login_service/login',
            type: "POST",
            dataType: "JSON",
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
            },
            success: function(response) {
                if (response.has_error) {
                    toastr.error(response.error_message);
                } else {
                    // console.log(response.session.User_type);
                    if(response.session.User_type == "faculty"){
                        window.location = base_url + "dashboard";
                    }
                    else if (response.session.User_type == "HR"){
                        window.location = base_url + "schedule";
                    }
                    else{
                        window.location = base_url + "dashboard";
                    }

                    
                }
            }
        });
        
    });

    $('#password').on('keyup', function (e) {
        if (e.keyCode == 13)
            $('#Login').click();
    });
});