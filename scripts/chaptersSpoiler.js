/**
 * Created by Wizlight on 06.09.2015.
 */
/**-------Спойлер змісту і іншого контента--------*/
function chapterSpoiler(el) {
    if ($('.spoilerBody').css('display')=='none') {
        $('#trg').text("\u25B2");
    }
    if($('.spoilerBody').css('display')=='block'){
        $('#trg').text("\u25BC");
    }
    $('.spoilerBody').toggle('normal');
    return false;
};