$(window).scroll(function(){
    $('#mainheader').css({
        'right': $(this).scrollLeft()
    });
    var marginleft = 800 - $(this).scrollLeft();
    $('#sidebarLesson').css({
        'margin-left':  marginleft
    });
});