$('.close-alert').click(function () {
    $('.alert-errors').hide();
});
$(document).ready(function(){
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

});