$(document).ready(function () {
    $('.confirm').click(function (e) {
        e.preventDefault();
        var lHref = $(this).attr('href');
        var myMessage = $(this).data('my-message');
        bootbox.confirm({
            message: myMessage,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    window.location.href = lHref;
                }
            }
        });
    });
    if ($('.alert-errors').length) {
        $('.alert-errors').delay(4000).fadeOut(1500);
    }
});
$('.close-alert').click(function () {
    $('.alert-errors').hide();
});
function registerValidate()
{
    $('.form-registration sup').text('');
    var valid = true;

    var email = $('#user_email').val();
    var password = $('#user_password').val();
    var password2 = $('#user_password2').val();

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,15})+$/;
    var result_email = regex.test(email);
    password = $.trim(password);
    var n1 = password.length;
    password2 = $.trim(password2)
    var n2 = password2.length;

    if (result_email == false) {
        $('.err-email').text(lang.invalid_email);
        valid = false;
    }
    if (n1 == 0) {
        $('.err-password').text(lang.invalid_pass);
        valid = false;
    }
    if (n2 == 0) {
        $('.err-password2').text(lang.invalid_pass2);
        valid = false;
    }
    if ((password != password2) && (n1 != 0 && n2 != 0)) {
        $('.err-password').text(lang.passwords_dont_match);
        $('.err-password2').text(lang.passwords_dont_match);
        valid = false;
    }
    var check_rules = $('#user_rules').is(":checked");
    if (!check_rules) {
        $('.err-rules').text(lang.rules_not_checked);
        valid = false;
    }
    if (valid == true) {
        document.getElementById("registerMe").submit();
    }
}