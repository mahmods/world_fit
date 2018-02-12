$(document).ready(function(){
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
      })
    var Slider =$('.header-slider').slick({
        arrows: false,
        infinite: true,
        speed: 2000,
        autoplay: true,
        fade: true,
        pauseOnHover: false
    });
    Slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
        $(slick.$slides[nextSlide]).children().children().children().each(function (index) {
            $(this).removeClass('animated');
            $(this).removeClass('slideInLeft');
            $(this).addClass('animated slideInLeft');
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
        $('#mobile-nav').fadetoggle();
    });
  });