$(window).scroll(function(){
    $('#mainheader').css({
        'right': $(this).scrollLeft()
    });
});