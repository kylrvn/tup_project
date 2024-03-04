$(document).ready(function () {
    $('#Login').on('click', function () {
        // const captchaResponse = grecaptcha.getResponse();

        // if(!captchaResponse.lenght > 0){
        //     throw new Error("Captcha not complete")
        // }
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
                    window.location = base_url + "faculty_schedule";
                }
            }
        });
        
    });

    $('#password').on('keyup', function (e) {
        if (e.keyCode == 13)
            $('#Login').click();
    });
});