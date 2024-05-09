/* BLOGGERS SLIDER
========================*/

window.addEventListener('load', function () {
    let lastX = 0;
    let el = document.getElementById("bloggers-scroll");
 
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