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
            success: function (response) {
                if (response.has_error) {
                    toastr.error(response.error_message);
                } else {
                    if(response.session.changePassword == 0){
                        window.location = base_url + "login/change_password";
                    }
                    else{
                        if (response.session.User_type == "1" || response.session.User_type == "2") {
                            window.location = base_url + "dashboard";
                        }
                        else if (response.session.User_type == "3") {
                            window.location = base_url + "schedule";
                        }
                        else {
                            window.location = base_url + "dashboard";
                        }
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