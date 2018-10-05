$(document).ready(function() {
    $("#preloader").css("display","none");
    $("#mainPage").css("display","block");
    $('.carousel').carousel({
      duration: 250
    });
    var inst = M.Carousel.getInstance($('.carousel'));
    setInterval(function(){inst.next();},2000);
    $("#mainPage").css("top","-1000");
    $("#mainPage").animate({
        top: 0
    }, 500);
});
