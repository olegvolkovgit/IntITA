/**
 * Created by Wizlight on 02.06.2015.
 */
/**-------Спойлер листа--------*/
function letterSpoiler(a){
    $(a).children('a').find('div').css('color','#c2bcbc');
    $(a).next('.spoilerBody').toggle('normal');
        return false;
    }

function myLetterSpoiler(b){
    $(b).next('.spoilerBody').toggle('normal');
    return false;
}