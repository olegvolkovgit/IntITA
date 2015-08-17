/**-------Спойлер змісту і іншого контента--------*/
$(document).ready(function(){
    $('.spoilerLinks').click(function(){
        var nameSpoiler = $(this).children("span:first").text();
        if(nameSpoiler=="(показати)"){
            $(this).children("span:first").text("(сховати)");
            $(this).children("span:last").text("\u25B2");
        } else if(nameSpoiler=="(сховати)"){
            $(this).children("span:first").text("(показати)");
            $(this).children("span:last").text("\u25BC");
        }
        $(this).next('.spoilerBody').toggle('normal');
        return false;
    });
});
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