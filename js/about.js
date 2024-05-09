/* ABOUT TABS - Designer & Smm Slider
=====================================*/

$(function() {
    let sliderDes =  $('#tab_desigher');
    let sliderSmm =  $('#tab_smm');

    
    sliderDes.slick({ 
        arrows: false,
        dots: true,
        autoplay: true,
        speed: 1000,
        // autoplaySpeed: 5000,
    });  

    sliderSmm.slick({ 
        arrows: false,
        dots: true,
        autoplay: true,
        speed: 1000,
        // autoplaySpeed: 5000,
    });  

    /* ABOUT TABS
    ========================*/
    const tabsBtn = document.querySelectorAll(".tabs__nav-btn");
    const tabsItems = document.querySelectorAll(".tabs__item");

    tabsBtn.forEach(onTabClick);

    function onTabClick(item) {
        item.addEventListener("click", function() {
            let currentBtn = item;
            let tabId = currentBtn.getAttribute("data-tab");
            let currentTab = document.querySelector(tabId);

            if( ! currentBtn.classList.contains('active')) {
                tabsBtn.forEach(function(item){
                    item.classList.remove('active');
                });                 
        
                tabsItems.forEach(function(item){
                    item.classList.remove('active');
                }); 
        
                currentBtn.classList.add('active');
                currentTab.classList.add('active');

                if(tabId == '#tab_3') {
                    sliderDes.slick('slickGoTo', 0, true); 
                } else if(tabId == '#tab_5') {
                    sliderSmm.slick('slickGoTo', 0, true); 
                }; 
            };  
        });
    }
    document.querySelector('.tabs__nav-btn').click();
});


/* ABOUT SCROLL
========================*/

window.addEventListener('load', function () {
   let lastX = 0;
   let el = document.getElementById("tabs-scroll");

   let ok = false;
   el.onmousedown = function (e) {
       ok = true;
   };
   document.onmouseup = function (e) {
       ok = false;
   };
   document.onmousemove = function (e) {
       if (ok) el.scrollLeft -= e.clientX - lastX;
       lastX = e.clientX;
   }

});