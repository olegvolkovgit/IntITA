/**------------------recall-------------------------*/
$(document).ready(function() {
    $('.spoiler-body').hide();
    $('.spoiler-title').click(function(){
        $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
        if($(this).hasClass('opened')) {
            var a=document.getElementById('id1').value;
            $(this).html(a + "\u25B2");
        }
        else {
            var b=document.getElementById('id2').value;
            $(this).html(b + "\u25BC");
        }

    });
});
function hideRecall(spoiler){
    $(spoiler).parent().prev('.spoiler-title').toggleClass('opened').toggleClass('closed').next().slideToggle();
    if($(spoiler).parent().prev('.spoiler-title').hasClass('opened')) {
        var a=document.getElementById('id1').value;
        $(spoiler).parent().prev('.spoiler-title').html(a + "\u25B2");
    }
    else {
        var b=document.getElementById('id2').value;
        $(spoiler).parent().prev('.spoiler-title').html(b + "\u25BC");
    }
}