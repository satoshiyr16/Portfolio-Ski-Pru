const open = document.getElementById('openbtn');
    open.addEventListener('click',function(){
      var target = document.getElementById('g-nav');
      target.classList.toggle('panelactive');
        // $(this).toggleClass('active');
});
