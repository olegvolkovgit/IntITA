/**
 * Created by Wizlight on 06.09.2015.
 */
/**-------Спойлер змісту і іншого контента--------*/
function chapterSpoiler(el) {
    if ($('#spoilerBody').css('display')=='none') {
        $('#spoilerTriangle').text("\u25B2");
    }
    if($('#spoilerBody').css('display')=='block'){
        $('#spoilerTriangle').text("\u25BC");
    }
    $('#spoilerBody').toggle('normal');
    return false;
};