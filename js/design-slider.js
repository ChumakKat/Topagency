$(function() {
    /* SLIDER https://kenwheeler.github.io/slick/ 
    =============================*/
    $('#slider-anim, #slider-social').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        swipe: true,
        swipeToSlide: true, 
      });
    });