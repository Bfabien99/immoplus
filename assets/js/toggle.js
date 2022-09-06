$(document).ready(function(){
    $('.toggle').on('click',function(){
        $('nav').toggleClass('active');
    })
})

let defile = document.querySelector('.defile');
    window.addEventListener('scroll',function(){
        defile.classList.toggle('show',window.scrollY>=2500);
    });