$(function() {

/* SLIDER https://kenwheeler.github.io/slick/ 
==============================*/
// $(window).load(function() {

  $('#main-slider').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    fade: true,
    cssEase:'linear',
    draggable: false,
    pauseOnFocus: false,
    pauseOnDotsHover: false,
    pauseOnHover: true,

    responsive: [
      {
        breakpoint: 992,
          settings: {pauseOnHover: false}
      }
    ]
  });
//});

});