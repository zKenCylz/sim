jQuery(document).ready(function() {
    jQuery('#membership-register-form').on('submit', function(e) {
        e.preventDefault();

        jQuery("#membership-register-form > .hover").show();
        jQuery("#membership-register-form > .loading").show();

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: membership_register_ajax.ajax_url,
            data: {
                'action': 'membership_register',
                'membership': jQuery("#membership-select-membership").val(),
                'name': jQuery("#membership-name").val(),
                'address': jQuery("#membership-address").val(),
                'phone': jQuery("#membership-phone").val(),
                'note': jQuery("#membership-note").val()
            },
            success: function(response){
                console.log(response);
                jQuery("#membership-register-form > .hover").hide();
                jQuery("#membership-register-form > .loading").hide();
                if (response.status == '0') {
                    jQuery("#membership-register-form .status").html(response.message);
                }
                else {
                    var str = 'Đăng ký thành công! Mã thanh toán: <strong>' + response.code + '</strong>. Vui lòng ghi mã thanh toán vào nội dung chuyển khoản!';
                    jQuery("#membership-register-form .status").html(str);
                }
            }
        });

        return false;
    });
});