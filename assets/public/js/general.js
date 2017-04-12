$(document).ready(function () {
    $(".carousel-caption img").fadeIn(3000);
    $('.carousel').carousel({
        pause: true,
        interval: false,
    });
    $("#collapseLogin").on("show.bs.collapse", function () {
        $('.support-top').hide();
    });
    $("#collapseLogin").on("hidden.bs.collapse", function () {
        $('.support-top').show();
    });
});