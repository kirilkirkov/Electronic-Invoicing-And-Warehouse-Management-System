/*
 * okay we lets ready :)
 * @description Users JavaScript
 */
$(document).ready(function () {
    /*
     * Confirm dialog
     */
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
    /*
     * Alerts fade out after 5sec.
     */
    if ($('.alert-errors').length) {
        $('.alert-errors').delay(4000).fadeOut(1500);
    }
});
/*
 * Alerts close
 */
$('.close-alert').click(function () {
    $('.alert-errors').hide();
});
/*
 * Checkbox maturity date in craete invoice page
 */
$('#maturity-date').change(function () {
    if ($(this).is(":checked")) {
        $('.maturity-date').show();
    } else {
        $('.maturity-date').hide();
    }
});
/*
 * Checkbox no vat in craete invoice page
 */
$('#no-vat').change(function () {
    if ($(this).is(":checked")) {
        $('.no-vat-container').hide();
        $('.the-vat').hide();
        $('.no-vat-txt').show();
    } else {
        $('.no-vat-container').show();
        $('.the-vat').show();
        $('.no-vat-txt').hide();
    }
});