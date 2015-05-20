/**
 Спойлер змісту і іншого контента
 */
$(document).ready(function(){
    $('.spoilerLinks').click(function(){
        var nameSpoiler = $(this).children("span:first").text();
        if(nameSpoiler=="Розгорнути"){
            $(this).children("span:first").text("Згорнути");
            $(this).children("span:last").text("\u25B2");
        } else if(nameSpoiler=="Згорнути"){
            $(this).children("span:first").text("Розгорнути");
            $(this).children("span:last").text("\u25BC");
        }
        $(this).next('.spoilerBody').toggle('normal');
        return false;
    });
});