$(function() {

/* SLIDER https://kenwheeler.github.io/slick/ 
==============================*/
$('#smm-slider').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 2000,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    swipe: true,
    swipeToSlide: true,
    autoplay: true,
    autoplaySpeed: 4000,
    pauseOnHover: false,
    responsive: [
      {
          breakpoint: 776,
          settings: {
            speed: 1000,
          }
      }
  ]
  });

});