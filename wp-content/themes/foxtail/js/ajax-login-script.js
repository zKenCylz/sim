jQuery(document).ready(function()
{
    // Perform AJAX login on form submit
    jQuery("#login-form").on("submit", function(e) {
        jQuery("#login-form > .hover").show();
        jQuery("#login-form > .loading").show();
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: ajax_login_object.ajaxurl,
            data: {
                "action": "ajaxlogin", //calls wp_ajax_nopriv_ajaxlogin
                "username": jQuery("#login-username").val(),
                "password": jQuery("#login-password").val(),
                "security": jQuery("#login-security").val() },
            success: function(response){
                jQuery("#login-form > .hover").hide();
                jQuery("#login-form > .loading").hide();
                if (response.success == true){
                    jQuery("#login-form .status").html("Đăng nhập thành công. Đang chuyển hướng ...");
                    location.reload(true);
                }
                else {
                    jQuery("#login-form .status").html(response.error);
                    console.log(response.error);
                }
            }
        });
        e.preventDefault();
        return false;
    });

    // Ajax register new user
    jQuery("#register-form").on("submit", function(e) {
        jQuery("#register-form > .hover").show();
        jQuery("#register-form > .loading").show();
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: ajax_login_object.ajaxurl,
            data: {
                "action": "ajaxregister", //calls wp_ajax_nopriv_ajaxregister
                "username": jQuery("#register-username").val(),
                "password": jQuery("#register-password").val(),
                "password_again": jQuery("#register-password_again").val(),
                "email": jQuery("#register-email").val(),
                "fname": jQuery("#register-fname").val(),
                "lname": jQuery("#register-lname").val(),
                "security": jQuery("#register-security").val()
            },
            success: function(response){
                jQuery("#register-form > .hover").hide();
                jQuery("#register-form > .loading").hide();
                jQuery("#register-form .status").html(response.message);

                if (response.success == true){
                    jQuery("#register-form .status").html("Đăng ký tài khoản thành công! Vui lòng kiểm tra email của bạn để xác nhận đăng ký!");
                }
                else {
                    jQuery("#register-form .status").html(response.error.join("<br>"));
                    //console.log(response.error);
                }
            }
            // end success
        });

        e.preventDefault();
        return false;
    });
});