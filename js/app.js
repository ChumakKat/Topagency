$(function() {

    /* BURGER */
    let bntBurger = $("#burger-btn");
    let nav = $("#nav");
    let body = $("body");
    let btn1 = $("#btn__line1");
    let btn2 = $("#btn__line2");
    let btn3 = $("#btn__line3");
    let wrapper = $("#wrapper");
    
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
        btn1.toggleClass("btn__close1");     
        btn2.toggleClass("btn__close2");     
        btn3.toggleClass("btn__close3"); 

        if (nav.hasClass('nav-show')) {  
            nav.removeClass('nav-transform');  
            nav.one('transitionend', function() {  
                nav.removeClass('nav-show');
                wrapper.removeClass("wrapper-show"); 
            });  

            setTimeout(function() {
                nav.removeClass('nav_burger_unlocked')
            }, 5);

        } else {
            wrapper.addClass("wrapper-show"); 
            nav.addClass('nav-show');
            setTimeout(function() {  
                nav.addClass('nav-transform');
            }, 1);
            
            nav.addClass('nav_burger_unlocked');
        }
    }
});