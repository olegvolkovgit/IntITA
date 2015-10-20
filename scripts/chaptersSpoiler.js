/**
 * Created by Wizlight on 06.09.2015.
 */
/**-------Спойлер змісту і іншого контента--------*/
function chapterSpoiler(el,a,b) {
    if ($('#spoilerBody').css('display')=='none') {
        $('#wordTrg').text(b);
        $('#trg').text("\u25B2");
    }
    if($('#spoilerBody').css('display')=='block'){
        $('#wordTrg').text(a);
        $('#trg').text("\u25BC");
    }
    $('#spoilerBody').toggle('normal');
    return false;
};