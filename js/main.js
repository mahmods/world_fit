$(document).ready(function(){
    var wow = new WOW().init();
    var Slider =$('.header-slider').slick({
        arrows: false,
        infinite: true,
        speed: 2000,
        autoplay: true,
        fade: true,
        pauseOnHover: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        centerMode: true,
    });
    $("div[class^='slide']").children().children().children().each(function (index) {
        var self = this;
        index += 1;
        $(self).css('visibility','hidden');
        setTimeout(function() {
            $(self).css('visibility','visible');
            $(self).addClass("animated fadeInLeft2");
        }, index * 500);
        $(this).bind("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",function(){
            $(this).removeClass('animated fadeInLeft2');
        });
    });
    Slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
        $(slick.$slides[nextSlide]).children().children().children().each(function (index) {
            var self = this;
            index += 1;
            $(self).css('visibility','hidden');
            setTimeout(function() {
                $(self).css('visibility','visible');
                $(self).addClass("animated fadeInLeft2");
            }, index * 500);
        });
      });
      Slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
        $(slick.$slides[currentSlide]).children().children().children().each(function (index) {
        });
      });
    $('.toggle-button').on('click', function() {
        slideout.toggle();
    });
    $('#mobile-toggler').on('click', function() {
        $('#mobile-nav').fadeToggle();
    });
  });