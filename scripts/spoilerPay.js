/**
 * Created by Wizlight on 02.06.2015.
 */
/**-------Спойлер ціни курсу--------*/
$(document).ready(function(){
    $('.spoilerLinks').click(function(){
        var nameSpoiler = $(this).children("span:first").text();
        if(nameSpoiler=="Розгорнути схеми проплат"){
            $(this).children("span:first").text("Згорнути схеми проплат");
            $(this).children("span:last").text("\u25B2");
        } else if(nameSpoiler=="Згорнути схеми проплат"){
            $(this).children("span:first").text("Розгорнути схеми проплат");
            $(this).children("span:last").text("\u25BC");
        }
        $('.spoilerBody').toggle('normal');
        return false;
    });
});