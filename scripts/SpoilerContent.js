/**-------Спойлер змісту і іншого контента--------*/
$(document).ready(function(){
    $('.spoilerLinks').click(function(){
        var nameSpoiler = $(this).children("span:first").text();
        if(nameSpoiler=="Розгорнути історію навчання"){
            $(this).children("span:first").text("Згорнути історію навчання");
            $(this).children("span:last").text("\u25B2");
        } else if(nameSpoiler=="Згорнути історію навчання"){
            $(this).children("span:first").text("Розгорнути історію навчання");
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
            $(this).html('Згорнути відгук  про навчання \u25B2');
        }
        else {
            var a=document.formName.id1.value;
            //var a=1111111;
            alert("a ="+ a); //для проверки
            $(this).html('Розгорнути відгук про навчання \u25BC');
        }

    });
});
