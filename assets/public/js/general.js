$(document).ready(function () {
    $("#collapseLogin .my-addr").val('');
    $('nav.navbar ul.nav li.dropdown').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });
    $(".carousel-caption img").fadeIn(3000);
    $('.carousel').carousel({
        pause: true,
        interval: false,
    });

    $("a.login").click(function () {
        return goToUrl();
    });
    $('#collapseLogin .my-addr').keypress(function (e) {
        var key = e.which;
        if (key == 13) {
            return goToUrl();
        }
    });
    function goToUrl() {
        var mine_addr = $("#collapseLogin .my-addr").val();
        var patt_addr = /^[a-zа-яA-ZА-Я0-9]+$/;
        var result_addr = patt_addr.test(mine_addr);
        if (mine_addr != '' && result_addr === true) {
            window.location.href = "http://" + mine_addr + ".pmticket.com";
            return false;
        }
    }
    $('#collapseLogin').on('shown.bs.collapse', function () {
        $("#collapseLogin .my-addr").focus();
    });
    $('#quote-carousel').carousel({
        pause: true,
        interval: 4000,
    });
});