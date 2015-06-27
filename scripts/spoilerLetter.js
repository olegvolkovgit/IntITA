/**
 * Created by Wizlight on 02.06.2015.
 */
/**-------Спойлер листа--------*/
function letterSpoiler(a){
    var nameSpoiler = $(a).children(".spoilerTriangle");
    if(nameSpoiler.html()=="+"){
        nameSpoiler.html("-");
    } else if(nameSpoiler.html()=="-"){
        nameSpoiler.html("+");
    }
    $(a).children('a').children('div').css('color','#c2bcbc');
    $(a).next('.spoilerBody').toggle('normal');
        return false;
    }

function myLetterSpoiler(b){
    $(b).next('.spoilerBody').toggle('normal');
    return false;
}