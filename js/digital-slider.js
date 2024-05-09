$(function() {
      $(window).on('load resize', function() {
        if ($(window).width() < 768 ) {
          $('#digital-slider:not(.slick-initialized)').slick({
                dots: true,
                arrows: false,
                infinite: false,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
          });
        } else {
          $("#digital-slider.slick-initialized").slick("unslick");
        }
      });
    });