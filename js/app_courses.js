$(function() {

    /* BURGER */
    let bntBurger = $("#burg-btn");
    let nav = $("#nav-cur");
    let body = $("body");
    let btn1 = $("#btn__line1");
    let btn2 = $("#btn__line2");
    let btn3 = $("#btn__line3");
    let wrapper = $("#wrapper");
    // let logo = $("#logo");
    
    $(bntBurger).on("click", function(event) {
         event.preventDefault();
         event.stopPropagation();
   
         burger_move();
    });

    $(nav).on("click", function(event) {
          event.stopPropagation();
    }); 

    $(wrapper).on("click", function() {
        if (wrapper.hasClass('wrapper-show') && (nav.hasClass('nav_burger_unlocked'))) {
            burger_move();               
        } 
    }); 

    function burger_move(){
        if (nav.hasClass('nav-show')) {
            btn1.removeClass("btn__close1");     
            btn2.removeClass("btn__close2");     
            btn3.removeClass("btn__close3"); 

            nav.removeClass('nav-transform');  
            nav.one('transitionend', function() {  
                nav.removeClass('nav-show');
              
                wrapper.removeClass("wrapper-show"); 
            });  

            setTimeout(function() {
                nav.removeClass('nav_burger_unlocked')
            }, 5);

        } else {
            btn1.addClass("btn__close1");     
            btn2.addClass("btn__close2");     
            btn3.addClass("btn__close3"); 

            wrapper.addClass("wrapper-show"); 
            nav.addClass('nav-show');
            setTimeout(function() {  
                nav.addClass('nav-transform');
            }, 1);
            // setTimeout(function() {  
            //     logo.addClass('logo-show');
            // }, 500);
            
            nav.addClass('nav_burger_unlocked');
        }
      }



    /* Smooth scroll */

    $("[data-scroll]").on("click", function(event) {
      event.preventDefault();

        let elementId = $(this).data('scroll');
        let elementOffset = $(elementId).offset().top;

        nav.removeClass("nav-show"); /* скрытие навигации при клике  на пункт меню */ 
        wrapper.removeClass("wrapper-show"); 

        btn1.removeClass("btn__close1");     
        btn2.removeClass("btn__close2");     
        btn3.removeClass("btn__close3"); 

        $("html, body").animate({
            scrollTop: elementOffset - 70
        }, 700);

    });

    /* Slider Merit */

    $(function() {
        $(window).on('load resize', function() {
          if ($(window).width() < 992 ) {
            $('#merit-slider:not(.slick-initialized)').slick({
                  dots: true,
                  arrows: false,
                  infinite: false,
                  speed: 500,
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
          } else {
            $("#merit-slider.slick-initialized").slick("unslick");
          }
        });
      });



    /* Slider Tariffs */

    $(function() {
        $(window).on('load resize', function() {
          if ($(window).width() < 700 ) {
            $('#tariffs-slider:not(.slick-initialized)').slick({
                  dots: true,
                  arrows: false,
                  infinite: false,
                  speed: 500,
                  slidesToShow: 1,
                  slidesToScroll: 1,
            });
          } else {
            $("#tariffs-slider.slick-initialized").slick("unslick");
          }
        });
      });


      /* Slider Argument */
    
      $('#argument-slider').slick({
          // fade: true,
          dots: false,
          arrows: false,
          infinite: true,
          speed: 1000,
          slidesToShow: 3,
      
          responsive: [
              {
                  breakpoint: 992,
                  settings: {
                      slidesToShow: 2,
                  }
              },
              {
                  breakpoint: 630,
                  settings: {
                      slidesToShow: 1,
                  }
              }
          ]
      });

        $(".slickPrev").on('click', function(event) {
          event.preventDefault();
          $('#argument-slider').slick("slickPrev");
      });

        $(".slickNext").on('click', function(event) {
          event.preventDefault();
          $('#argument-slider').slick("slickNext");
      });


      /* Slider Reviews */
    
      $('#reviews-slider').slick({
        // fade: true,
        dots: false,
        arrows: false,
        infinite: true, 
        speed: 1000,
        slidesToShow: 2,
        // centerMode:true,
    
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

      $(".slickPrev-rev").on('click', function(event) {
        event.preventDefault();
        $('#reviews-slider').slick("slickPrev");
    });

      $(".slickNext-rev").on('click', function(event) {
        event.preventDefault();
        $('#reviews-slider').slick("slickNext");
    });



    // /* Submit */

    // const submitCours = $("#submit_cours");
    // const modalCours = $("#modal_send");

    // submitCours.on("click", function(event) {
    //   event.preventDefault();

    //   modalCours.addClass('show');


    // });






        



     






});

 /* Program Plan Accordion */

function show_shade(cart_name) {
    let cardShad = document.getElementById(cart_name);
    let cardBtn = document.getElementById(cart_name + '_b');

    cardShad.classList.toggle("active");
    cardBtn.classList.toggle("trans");
}


 