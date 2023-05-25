const open = document.getElementById('openbtn');
open.addEventListener('click',function(){
    $(this).toggleClass('active');
    $("#g-nav").toggleClass('panelactive');
});


